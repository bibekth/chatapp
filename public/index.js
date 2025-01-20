const authToken = localStorage.getItem("auth_token");
var currentUser = {};
var API_URL = '';
var pusher_config = '';
$(document).ready(function () {
    $.ajax({
        method: 'GET',
        url: '/',
        async: false,
        success: function (data) {
            currentUser = data.currentUser;
            API_URL = data.url;
            pusher_config = data.pusher_config;
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
    const chatBox = document.getElementById("chat-box");
    const userId = '';
    let subscribedChannels = {};
    Pusher.logToConsole = false;

    var pusher = new Pusher(pusher_config['key'], {
        cluster: pusher_config['options']['cluster'],
        forceTLS: pusher_config['options']['useTLS'],
        userAuthentication: {
            endpoint: "/pusher/auth",
            transport: "ajax",
            params: {},
            headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
            customHandler: null,
        }
    });
    // pusher.signin();

    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    $('.my-friend').click(function () {
        const userId = $(this).attr('data-user');
        const username = $(this).attr('data-name');
        setupChat(userId, username, chatBox, currentUser, subscribedChannels, pusher);
    });
    $('#user-list-my-friend').on('click', '.my-friend', function () {
        const userId = $(this).attr('data-user');
        const username = $(this).attr('data-name');
        setupChat(userId, username, chatBox, currentUser, subscribedChannels, pusher);
        $('#search-box-my-friend').val('');
        $('#user-list-my-friend').hide();
    });
    $('#chat-input').keydown(function (e) {
        if (e.key === "Enter" && $(this).val().trim()) {
            const message = $(this).val().trim();
            saveMessage(message, $(this).attr('data-user'))
        }
    });
    $('#send-message').click(function () {
        const message = $('#chat-input').val().trim();
        saveMessage(message, $(this).attr('data-user'))
    });
});
function saveMessage(message, userId) {
    $.ajax({
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            message: message,
        },
        url: '/store-message/' + userId,
        success: function (data) {
            if (data.status == 'success') {
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                $('#chat-input').val('');
            }
        }
    });
}
function setupChat(userId, username, chatBox, currentUser, subscribedChannels, pusher) {
    const channelName = currentUser.id > userId ? "private-channel-" + userId + '-' + currentUser.id : "private-channel-" + currentUser.id + '-' + userId;

    // Set up chat UI
    $('#chat-title').html('Chat with ' + username);
    $('#chat-input').attr('data-user', userId);
    $('#send-message').attr('data-user', userId);
    chatBox.innerHTML = "";
    $('#submit-message-input').attr('action', '/store-message/' + userId);

    // Retrieve previous messages
    $.ajax({
        method: 'get',
        url: '/retrieve-msg/' + userId,
        success: function (data) {
            data.data.forEach((msg) => {
                const message = document.createElement("div");
                message.className = "mb-2";
                if (msg.from == currentUser.id) {
                    message.textContent = 'You: ' + msg.message;
                } else {
                    message.textContent = username + ': ' + msg.message;
                }
                chatBox.appendChild(message);
            });
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        }
    });

    // Subscribe to the Pusher channel if not already subscribed
    if (!subscribedChannels[channelName]) {
        const channel = pusher.subscribe(channelName);
        subscribedChannels[channelName] = channel;

        const eventName = currentUser.id > userId ? 'client-event-' + userId + '-' + currentUser.id : 'client-event-' + currentUser.id + '-' + userId;
        channel.bind(eventName, (data) => {
            const pusher_message = document.createElement("div");
            pusher_message.className = "mb-2";
            if (data.message.from == currentUser.id) {
                pusher_message.textContent = 'You: ' + data.message.message;
            } else {
                pusher_message.textContent = username + ': ' + data.message.message;
            }
            chatBox.appendChild(pusher_message);
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        });
    }
}
async function searchUsers(query, section) {
    if (section == 'add') {
        try {
            const response = await axios.get(`${API_URL}/find-user?username=${query}&section=${section}`, {
                headers: { Authorization: `Bearer ${authToken}` },
            });

            if (response.data.length === 0) {
                document.getElementById("user_not_found-add-friend").style.display = "inline";
                document.getElementById("user-list-add-friend").innerHTML = "";
            } else {
                document.getElementById("user_not_found-add-friend").style.display = "none";
                displayUsers(response.data, section);
            }
        } catch (err) {
            document.getElementById("user_not_found-add-friend").style.display = "inline";
            document.getElementById("user-list-add-friend").innerHTML = "";
        }
    } else if (section == 'request') {
        try {
            const response = await axios.get(`${API_URL}/find-user?username=${query}&section=${section}`, {
                headers: { Authorization: `Bearer ${authToken}` },
            });
            if (response.data.length === 0) {
                document.getElementById("user_not_found-requests").style.display = "inline";
                document.getElementById("user-list-requests").innerHTML = "";
            } else {
                document.getElementById("user_not_found-requests").style.display = "none";
                displayUsers(response.data, section);
            }
        } catch (err) {
            document.getElementById("user_not_found-requests").style.display = "inline";
            document.getElementById("user-list-requests").innerHTML = "";
        }
    } else if (section == 'my') {
        try {
            const response = await axios.get(`${API_URL}/find-user?username=${query}&section=${section}`, {
                headers: { Authorization: `Bearer ${authToken}` },
            });
            if (response.data.length === 0) {
                document.getElementById("user_not_found-my-friend").style.display = "inline";
                document.getElementById("user-list-my-friend").innerHTML = "";
            } else {
                document.getElementById("user_not_found-my-friend").style.display = "none";
                displayUsers(response.data, section);
            }
        } catch (err) {
            document.getElementById("user_not_found-my-friend").style.display = "inline";
            document.getElementById("user-list-my-friend").innerHTML = "";
        }
    }
}
function displayUsers(users, section) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token
    if (section == 'add') {
        var userList = document.getElementById("user-list-add-friend");
        userList.innerHTML = "";
        users.forEach((user) => {
            if (user.status == 1) {
                var form = `<form action="/add-friend?event=cancel&to=` + user.id + `" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="POST">
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Cancel Request</button>
                        </div>
                    </form>`
            } else {
                var form = `<form action="/add-friend?event=add&to=` + user.id + `" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="POST">
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Add Friend</button></div>
                    </form>`
            }
            const item = document.createElement("li");
            item.className = "list-group-item list-group-item-action d-flex justify-content-between pt-1 pb-2";
            item.innerHTML = user.username + form;
            userList.appendChild(item);
        });
    } else if (section == 'request') {
        var userList = document.getElementById("user-list-requests");
        userList.innerHTML = "";
        users.forEach((user) => {

            var form = `<form action="/add-friend?event=accept&from=` + user.id + `" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="POST">
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Accept</button></div>
                    </form>
                    <form action="/add-friend?event=decline&from=`+ user.id + `" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="POST">
                        <div class="add-friend"><button class="btn btn-sm btn-outline-danger">Decline</button></div>
                    </form>`;
            const item = document.createElement("li");
            item.className = "list-group-item list-group-item-action d-flex justify-content-between pt-1 pb-2";
            item.innerHTML = user.username + form;
            userList.appendChild(item);
        });
    } else if (section == 'my') {
        var userList = document.getElementById("user-list-my-friend");
        userList.innerHTML = "";
        users.forEach((user) => {
            const item = document.createElement("li");
            item.className = "my-friend list-group-item list-group-item-action d-flex justify-content-between pt-1 pb-2";
            item.setAttribute("id", `friend-${user.id}`);
            item.setAttribute("data-user", user.id);
            item.setAttribute("data-name", user.username);
            item.innerHTML = user.username;
            userList.appendChild(item);
        });
    }
}
document.getElementById("search-box-add-friend").addEventListener("input", (e) => {
    const query = e.target.value.trim();
    if (query.length === 0) {
        document.getElementById("user_not_found-add-friend").style.display = "none";
        document.getElementById("user-list-add-friend").innerHTML = "";
        return;
    }
    searchUsers(query, 'add');
});
document.getElementById("search-box-requests").addEventListener("input", (e) => {
    const query = e.target.value.trim();
    if (query.length === 0) {
        document.getElementById("user_not_found-requests").style.display = "none";
        document.getElementById("user-list-requests").innerHTML = "";
        return;
    }
    searchUsers(query, 'request');
});
document.getElementById("search-box-my-friend").addEventListener("input", (e) => {
    const query = e.target.value.trim();
    if (query.length === 0) {
        document.getElementById("user_not_found-my-friend").style.display = "none";
        document.getElementById("user-list-my-friend").innerHTML = "";
        return;
    }
    searchUsers(query, 'my');
});

document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('themeToggle');
    const currentMode = localStorage.getItem('theme') || 'light';

    // Set initial mode based on saved preference
    if (currentMode === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        toggle.checked = true;
    }

    // Toggle mode when checkbox is changed
    toggle.addEventListener('change', function () {
        const isDarkMode = toggle.checked;
        if (isDarkMode) {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    });
});


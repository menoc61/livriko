@extends('admin.layouts.master')
@section('title', __('static.chats.chats'))
@section('content')
    <div class="chatting-main-box">
        <div class="container-fluid">
            <div class="row g-md-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-md-5">
                    <div class="left-sidebar-wrapper">
                        <div class="contentbox">
                            <div class="inside">
                                <div class="contentbox-title">
                                    <div class="contentbox-subtitle">
                                        <h3>{{ __('static.chats.chats') }}</h3>
                                    </div>
                                </div>
                                <div class="advance-options">
                                    <ul class="nav nav-tabs driver-tabs custom-scrollbar" id="userRoleTabs" style="flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                        <li class="nav-item">
                                            <button class="nav-link active" id="recent-tab" data-bs-toggle="tab"
                                                data-bs-target="#recent-tab-pane">{{ __('static.recent_chats') }}</button>
                                        </li>
                                        @foreach($roles as $role)
                                            <li class="nav-item">
                                                <button class="nav-link role-tab" id="role-{{ $role->id }}-tab" data-bs-toggle="tab"
                                                    data-role-id="{{ $role->id }}"
                                                    data-bs-target="#role-tab-pane">{{ ucfirst($role->name) }} ({{ $role->users_count }})</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content custom-scrollbar" id="chat-options-tabContent">
                                        <!-- Recent Chats / All Tab -->
                                        <div class="tab-pane fade show active" id="recent-tab-pane">
                                            <form class="chat-search-box">
                                                <i class="ri-search-line"></i>
                                                <input type="text" id="chatSearchRecent" class="form-control"
                                                    placeholder="{{ __('static.chats.search_user') }}">
                                            </form>
                                            <ul class="chats-user" id="recentChatsList">
                                                @forelse($recentChats as $chat)
                                                    <li class="chat-item" data-user-id="{{ $chat['user_id'] }}"
                                                        data-user-name="{{ $chat['name'] }}"
                                                        data-user-image="{{ $chat['image'] }}"
                                                        data-user-role="{{ $chat['role'] }}">
                                                        <div class="chat-box">
                                                            <div class="active-profile">
                                                                @if ($chat['image'])
                                                                    <img class="img-fluid rounded-circle"
                                                                        src="{{ $chat['image'] }}"
                                                                        alt="user">
                                                                @else
                                                                    <div class="user-round">
                                                                        <h6>{{ strtoupper($chat['name'][0]) }}</h6>
                                                                    </div>
                                                                @endif
                                                                <span class="badge bg-danger unread-badge {{ $chat['unread_count'] > 0 ? '' : 'd-none' }}" id="unread-{{ $chat['user_id'] }}">{{ $chat['unread_count'] }}</span>
                                                            </div>
                                                    <div class="name-chat">
                                                                <div class="w-100">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h5 class="chat-user-name">{{ $chat['name'] }}</h5>
                                                                        <small class="text-muted chat-time">{{ \Carbon\Carbon::parse($chat['updated_at'])->diffForHumans() }}</small>
                                                                    </div>
                                                                     <h6 class="chat-role">{{ $chat['role'] }}</h6>
                                                                     <p class="last-message-text text-truncate" style="max-width: 150px; font-size: 12px; margin: 0;">{{ $chat['last_message']['message'] ?? (isset($chat['last_message']['images']) && count($chat['last_message']['images']) > 0 ? 'Sent an image' : '') }}</p>
                                                                 </div>
                                                             </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="chat-item no-data-tab">
                                                        <img src="{{ asset('images/no-user.png') }}" class="img-fluid" alt="No chats">
                                                        <p>{{ __('static.chats.no_chats_found') }}</p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>

                                        <!-- Dynamic Roles Content (Reuses same pane) -->
                                        <div class="tab-pane fade" id="role-tab-pane">
                                            <form class="chat-search-box">
                                                <i class="ri-search-line"></i>
                                                <input type="text" id="chatSearchRoleUsers" class="form-control"
                                                    placeholder="{{ __('static.chats.search_user') }}">
                                            </form>
                                            <ul class="chats-user" id="roleUsersList">
                                                <!-- Populated via AJAX -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8 col-md-7">
                    <div class="right-sidebar-chat">
                        <div class="contentbox">
                            <div class="inside">
                                <div class="no-data-container" id="noDataContainer">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('images/no-chat.png') }}" class="img-fluid" alt="No user selected">
                                        <h4 class="mt-4">{{ __('static.chats.select_a_user') }}</h4>
                                    </div>
                                </div>
                                <div class="chat-content-view d-none">
                                    <div class="right-sidebar-title">
                                        <div class="common-space">
                                            <div class="chat-time-chat">
                                                <div class="chat-top-box">
                                                    <div class="chat-profile">
                                                        <div id="receiverAvatarContainer">
                                                            <img class="img-fluid rounded-circle" id="receiverAvatar"
                                                                src="{{ asset('images/no-user.png') }}" alt="user">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 id="activeChatName"></h5>
                                                        <h6 class="receiverRole"></h6>
                                                    </div>
                                                </div>
                                                <div class="chatting-option">
                                                    <a href="javascript:void(0)" id="clearChat" data-bs-toggle="modal"
                                                        data-bs-target="#confirmation">
                                                        <i class="ri-brush-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-sidebar-Chats">
                                        <div class="message">
                                            <div class="msger-chat custom-scrollbar" id="messages">
                                                <div id="loading" class="text-center p-3">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                    {{ __('static.chats.load_message') }}
                                                </div>
                                                <div id="noMessages" class="text-center p-3 d-none">
                                                    {{ __('static.chats.no_messages_yet') }}
                                                </div>
                                            </div>
                                            <form class="msger-inputarea">
                                                <div class="position-relative">
                                                    <input class="msger-input" type="text" id="messageInput"
                                                        placeholder="{{ __('static.chats.type_message') }}">
                                                    <button class="msger-send-btn" type="button" id="sendBtn">
                                                        <i class="ri-send-plane-line"></i>
                                                    </button>
                                                    <input type="file" id="sendImage" accept="image/*" style="display:none;" multiple>
                                                    <button type="button" id="uploadImage" class="gallery">
                                                        <i class="ri-image-line"></i>
                                                    </button>

                                                    <div id="uploadProgress" class="progress mt-2" style="display:none; height: 5px;">
                                                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade confirmation-modal" id="confirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start confirmation-data">
                    <div class="main-img">
                        <div class="delete-icon">
                            <i class="ri-question-mark"></i>
                        </div>
                    </div>
                    <h4 class="modal-title">{{ __('static.chats.confirmation') }}</h4>
                    <p>{{ __('static.chats.modal') }}</p>
                    <div class="d-flex">
                        <button type="button" class="btn cancel btn-light me-2" data-bs-dismiss="modal">{{ __('static.no') }}</button>
                        <button type="button" class="btn btn-primary delete" id="confirmClearChat">{{ __('static.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .unread-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 10;
        }
        .active-profile {
            position: relative;
        }
    </style>
@endsection

@push('scripts')
<script>
    const BASE_URL = "{{ url('/') }}";
    const ACCESS_TOKEN = "{{ $access_token }}";
    const MY_USER_ID = String("{{ auth()->id() }}");

    let echo;
    let currentChatRoomId = null;
    let previousChatRoomId = null;
    let currentReceiverId = null;

    $(document).ready(function() {
        initSocket();
        initUI();
    });

    function initSocket() {
        echo = window.Echo;
        console.log('[Chat] Socket Active');
        echo.private(`user.notifications.${MY_USER_ID}`)
            .listen('.unread.count.updated', (e) => {
                console.log("[Global] Notification Received", e);
                refreshUnreadCount();

                // Update Sidebar
                if (e.roomId) {
                    const userId = currentChatRoomId === e.roomId ? currentReceiverId : e.roomId.split('_').find(id => id !== MY_USER_ID);
                    console.log("[Global] Notification for Room:", e.roomId, "Calculated User ID:", userId);

                    // Diagnostic: Log all IDs in sidebar
                    let sidebarIds = [];
                    $(`#recentChatsList li.chat-item`).each(function() {
                        sidebarIds.push($(this).attr('data-user-id'));
                    });
                    console.log("[Global] Sidebar IDs present:", sidebarIds);

                    const chatItem = $(`#recentChatsList li[data-user-id="${userId}"]`);

                    if (chatItem.length) {
                        console.log("[Global] Found sidebar item for user", userId);
                        // Update unread badge
                        if (e.roomUnread !== undefined) {
                            const badge = $(`#unread-${userId}`);
                            badge.text(e.roomUnread).toggleClass('d-none', e.roomUnread === 0);
                        }

                        // Move to top only if it's a new message (contains lastMessage content)
                        if (e.lastMessage) {
                            console.log("[Global] Updating last message text to:", e.lastMessage);
                            chatItem.find('.last-message-text').text(e.lastMessage);
                            chatItem.find('.chat-time').text('Just now');
                            chatItem.prependTo('#recentChatsList');
                        }
                    } else {
                        console.log("[Global] Sidebar item NOT found for user", userId);
                        if (e.lastMessage) {
                            refreshRecentChatsList();
                        }
                    }
                }
            });
    }

    function initUI() {
        // Role Tab Click
        $('.role-tab').on('click', function() {
            const roleId = $(this).data('role-id');
            loadUsersByRole(roleId);
        });

        // Search Handlers
        $('#chatSearchRecent').on('keyup', function() {
            const val = $(this).val().toLowerCase();
            $('#recentChatsList li.chat-item').filter(function() {
                $(this).toggle($(this).data('user-name').toLowerCase().indexOf(val) > -1);
            });
        });

        $('#chatSearchRoleUsers').on('keyup', function() {
            const val = $(this).val().toLowerCase();
            $('#roleUsersList li.chat-item').filter(function() {
                $(this).toggle($(this).data('user-name').toLowerCase().indexOf(val) > -1);
            });
        });

        // Click on chat user
        $(document).on('click', '.chat-item', function() {
            if ($(this).hasClass('no-data-tab')) return;

            const userId = String($(this).data('user-id'));
            const name = $(this).data('user-name');
            const role = $(this).data('user-role');
            const image = $(this).data('user-image');

            $('.chat-item').removeClass('active');
            $(this).addClass('active');

            openChat(userId, name, role, image);
        });

        $('#sendBtn').on('click', sendMessage);
        $('#messageInput').on('keypress', function(e) {
            if (e.which === 13) {
                sendMessage();
                return false;
            }
        });

        $('#uploadImage').on('click', () => $('#sendImage').click());
        $('#sendImage').on('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) uploadAndSendImages(files);
        });

        $('#confirmClearChat').on('click', function() {
            clearChat();
            $('#confirmation').modal('hide');
        });
    }

    function loadUsersByRole(roleId) {
        $('#roleUsersList').html('<li class="text-center p-3"><i class="fa fa-spinner fa-spin"></i> Loading...</li>');

        fetch(`${BASE_URL}/admin/chat/users?role_id=${roleId}`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            let html = '';
            if (res.data.length > 0) {
                res.data.forEach(user => {
                    const avatar = user.profile_image ? `<img class="img-fluid rounded-circle" src="${user.profile_image.original_url}">`
                                                      : `<div class="user-round"><h6>${user.name[0].toUpperCase()}</h6></div>`;

                    const time = user.last_interaction ? formatJSDate(user.last_interaction) : '';

                    html += `
                        <li class="chat-item" data-user-id="${user.id}" data-user-name="${user.name}" data-user-role="${user.role?.name || ''}" data-user-image="${user.profile_image?.original_url || ''}">
                            <div class="chat-box">
                                <div class="active-profile">${avatar}</div>
                                <div class="name-chat">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="chat-user-name">${user.name}</h5>
                                            <small class="text-muted chat-time">${time}</small>
                                        </div>
                                        <h6>${user.role?.name || ''}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>`;
                });
            } else {
                html = '<li class="chat-item no-data-tab p-3 text-center">No users found</li>';
            }
            $('#roleUsersList').html(html);
        });
    }

    function openChat(userId, name, role, image) {
        currentReceiverId = userId;
        currentChatRoomId = generateRoomId(MY_USER_ID, userId);
        $('#activeChatName').text(name);
        $('.receiverRole').text(role);
        $('#receiverAvatarContainer').html(
            image ? `<img class="img-fluid rounded-circle" src="${image}">`
                  : `<div class="user-round"><h6>${name[0].toUpperCase()}</h6></div>`
        );

        $('#noDataContainer').addClass('d-none');
        $('.chat-content-view').removeClass('d-none');
        $('#messages').empty();
        $('#loading').show();

        // Join Echo room
        listenToRoom(currentChatRoomId);
        loadMessages(currentChatRoomId);
        $(`#unread-${userId}`).addClass('d-none').text('0');
    }

    function generateRoomId(id1, id2) {
        return [Number(id1), Number(id2)].sort((a, b) => a - b).join('_');
    }

    function listenToRoom(roomId) {
        // Prevent stacking listeners
        if (previousChatRoomId) {
            console.log("[Chat] Leaving previous room channel:", previousChatRoomId);
            echo.leave(`chat.room.${previousChatRoomId}`);
        }

        previousChatRoomId = roomId;
        console.log("[Chat] Joining room channel:", roomId);
        echo.private(`chat.room.${roomId}`)
            .listen('.chat.message.sent', (e) => {
                console.log("[Chat] Message Event Received", e);
                // Payload is now flat thanks to broadcastWith()
                if (String(e.room_id) === String(currentChatRoomId)) {
                    appendMessage(e);
                    scrollToBottom();
                    markRoomAsRead(currentChatRoomId);
                } else {
                    console.log("[Chat] Room ID mismatch:", e.room_id, "vs", currentChatRoomId);
                }
            });
    }

    function markRoomAsRead(roomId) {
        fetch(`${BASE_URL}/api/chat/messages?room_id=${roomId}`, {
            headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
        });
    }

    function loadMessages(roomId) {
        fetch(`${BASE_URL}/api/chat/messages?room_id=${roomId}`, {
            headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            $('#loading').hide();
            $('#messages').empty();
            if (res.data && res.data.length > 0) {
                $('#noMessages').addClass('d-none');
                res.data.forEach(msg => appendMessage(msg));
                scrollToBottom();
            } else {
                $('#noMessages').removeClass('d-none');
            }
            refreshUnreadCount();
        });
    }

    function sendMessage() {
        const text = $('#messageInput').val().trim();
        if (!text || !currentChatRoomId) return;

        fetch(`${BASE_URL}/api/chat/send`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${ACCESS_TOKEN}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                room_id: currentChatRoomId,
                receiver_id: currentReceiverId,
                message: text
            })
        })
        .then(res => res.json())
        .then(res => {
            if (res.status) {
                appendMessage(res.data);
                scrollToBottom();

                // Move recipient to top of sidebar
                const chatItem = $(`#recentChatsList li[data-user-id="${currentReceiverId}"]`);
                if (chatItem.length) {
                    chatItem.find('.last-message-text').text(text);
                    chatItem.find('.chat-time').text('Just now');
                    chatItem.prependTo('#recentChatsList');
                } else {
                    refreshRecentChatsList();
                }
            }
        });

        $('#messageInput').val('');
    }

    function appendMessage(msg) {
        console.log("[Chat] Appending message:", msg);
        const isMe = String(msg.sender_id) === MY_USER_ID;
        const bubbleClass = isMe ? 'admin-reply' : 'user-reply';
        console.log("[Chat] Is Me?", isMe, "Bubble Class:", bubbleClass);
        let content = msg.message ? `<p>${msg.message}</p>` : '';

        if (msg.images && msg.images.length > 0) {
            content += msg.images.map(img => `<img src="${img}" class="img-fluid rounded mt-2" style="max-width: 200px;">`).join('');
        }

        const html = `
            <div class="${bubbleClass}">
                <div class="chatting-box">
                    ${content}
                    <div class="chat-time"><span>${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span></div>
                </div>
            </div>`;

        $('#messages').append(html);
        $('#noMessages').addClass('d-none');
    }

    function scrollToBottom() {
        const el = document.getElementById('messages');
        el.scrollTop = el.scrollHeight;
    }

    async function uploadAndSendImages(files) {
        $('#uploadProgress').show();
        
        const formData = new FormData();
        formData.append('room_id', currentChatRoomId);
        formData.append('receiver_id', currentReceiverId);
        
        for (let i = 0; i < files.length; i++) {
            formData.append('images[]', files[i]);
        }

        try {
            const res = await fetch(`${BASE_URL}/api/chat/send`, {
                method: 'POST',
                headers: { 
                    'Authorization': `Bearer ${ACCESS_TOKEN}`,
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (data.status) {
                appendMessage(data.data);
                scrollToBottom();

                // Move recipient to top of sidebar
                const chatItem = $(`#recentChatsList li[data-user-id="${currentReceiverId}"]`);
                if (chatItem.length) {
                    chatItem.find('.last-message-text').text('Sent an image');
                    chatItem.find('.chat-time').text('Just now');
                    chatItem.prependTo('#recentChatsList');
                } else {
                    refreshRecentChatsList();
                }
            }
        } catch (e) {
            console.error('Error uploading images', e);
        }

        $('#uploadProgress').hide();
        $('#sendImage').val('');
    }

    function clearChat() {
        fetch(`${BASE_URL}/api/chat/clear`, {
            method: 'POST',
            headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Content-Type': 'application/json' },
            body: JSON.stringify({ room_id: currentChatRoomId })
        }).then(() => { $('#messages').empty(); $('#noMessages').removeClass('d-none'); });
    }

    function refreshUnreadCount() {
        fetch(`${BASE_URL}/api/chat/unread-count`, {
            headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            if (res.status) {
                const count = res.total_unread;
                const badge = $('#chat-notification-count');
                if (count > 0) {
                    badge.text(count).show();
                } else {
                    badge.hide();
                }
            }
        });
    }

    function refreshRecentChatsList() {
        fetch(`${BASE_URL}/admin/chat/recent`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            if (res.status) {
                let html = '';
                const chats = Object.values(res.data);
                if (chats.length > 0) {
                    chats.forEach(chat => {
                        const avatar = chat.image ? `<img class="img-fluid rounded-circle" src="${chat.image}">`
                                                  : `<div class="user-round"><h6>${chat.name[0].toUpperCase()}</h6></div>`;

                        const time = chat.updated_at ? formatJSDate(chat.updated_at) : '';
                        const isActive = currentReceiverId === String(chat.user_id) ? 'active' : '';
                        const snippet = chat.last_message?.message || (chat.last_message?.images?.length > 0 ? 'Sent an image' : '');

                        html += `
                            <li class="chat-item ${isActive}" data-user-id="${chat.user_id}" data-user-name="${chat.name}" data-user-role="${chat.role}" data-user-image="${chat.image || ''}">
                                <div class="chat-box">
                                    <div class="active-profile">
                                        ${avatar}
                                        <span class="badge bg-danger unread-badge ${chat.unread_count > 0 ? '' : 'd-none'}" id="unread-${chat.user_id}">${chat.unread_count}</span>
                                    </div>
                                    <div class="name-chat">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="chat-user-name">${chat.name}</h5>
                                                <small class="text-muted chat-time">${time}</small>
                                            </div>
                                            <h6 class="chat-role">${chat.role}</h6>
                                            <p class="last-message-text text-truncate" style="max-width: 150px; font-size: 12px; margin: 0;">${snippet}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
                    });
                } else {
                    html = `<li class="chat-item no-data-tab">
                                <p>{{ __('static.chats.no_chats_found') }}</p>
                            </li>`;
                }
                $('#recentChatsList').html(html);
            }
        });
    }

    function formatJSDate(dateStr) {
        const date = new Date(dateStr);
        const now = new Date();
        const diff = (now - date) / 1000;

        if (diff < 86400 && now.getDate() === date.getDate()) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
        return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
    }
</script>
@endpush

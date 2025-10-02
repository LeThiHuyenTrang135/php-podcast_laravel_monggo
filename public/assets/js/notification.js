// public/assets/js/notification.js
(function () {
  // helper: lấy content meta an toàn
  const getMeta = (name) =>
    document.querySelector(`meta[name="${name}"]`)?.getAttribute('content')?.trim() || '';

  const userId = getMeta('user-id');               // "" nếu chưa đăng nhập
  const WS_CLIENT = getMeta('ws-client') || 'ws://127.0.0.1:8080/ws';

  // Không có userId thì KHÔNG kết nối WS (tránh lỗi ws://...?user_id=)
  if (!userId) {
    console.warn('WS: skip connect because user_id is empty');
  } else {
    // Chỉ tạo socket khi có userId
    let socket;
    try {
      socket = new WebSocket(`${WS_CLIENT}?user_id=${encodeURIComponent(userId)}`);

      socket.onmessage = function (e) {
        try {
          const data = JSON.parse(e.data);
          createNotification(data);
        } catch (err) {
          console.error('WS message parse error:', err);
        }
      };

      socket.onerror = (e) => console.error('WS error', e);
      socket.onclose  = (e) => console.warn('WS closed', e.code);
    } catch (err) {
      console.error('WS init failed:', err);
    }

    // Cho phép dùng ở nơi khác nếu cần
    window.__notifySocket = socket;
  }

  function createNotification(data) {
    const list = document.getElementById('__notification_list');
    if (list) {
      list.innerHTML =
        `<li><a href="/podcast/redirect/${data.podcast_id}">${data.content}</a></li>` + list.innerHTML;
    }

    document.querySelectorAll('.notification_counts').forEach((el) => {
      const curr = parseInt(el.innerText || '0', 10) || 0;
      el.innerText = String(curr + 1);
      el.classList.remove('hide');
    });
  }

  async function readNewNotifications() {
    try {
      // Ẩn badge đếm
      document.querySelectorAll('.notification_counts').forEach((el) => {
        el.innerText = '0';
        el.classList.add('hide');
      });

      // Hàm createHeaderRequest() đã có sẵn ở dự án của bạn
      const response = await fetch(`/api/notifications`, {
        method: 'GET',
        headers: createHeaderRequest(),
      });

      const data = await response.json();
      console.log({ notifications: data });
    } catch (err) {
      console.error('readNewNotifications error:', err);
    }
  }

  // Gắn listener an toàn (chỉ gắn khi có phần tử)
  const labels = document.querySelectorAll('.notification_label');
  if (labels.length) {
    labels.forEach((el) => el.addEventListener('mouseover', readNewNotifications));
  } else {
    console.warn('notification.js: .notification_label not found – skip binding');
  }

  // (tuỳ chọn) sender
  function sendMessage(msg) {
    if (window.__notifySocket && window.__notifySocket.readyState === 1) {
      window.__notifySocket.send(JSON.stringify(msg));
    } else {
      console.warn('WS not connected, skip send');
    }
  }
  window.__sendNotification = sendMessage;

  // (tuỳ chọn) lưu DB
  async function saveNotification(data) {
    try {
      const res = await fetch('/api/notifications', {
        method: 'POST',
        headers: createHeaderRequest(),
        body: JSON.stringify({ ...data }),
      });
      console.log('saveNotification:', await res.json());
    } catch (err) {
      console.error('saveNotification error:', err);
    }
  }
  window.__saveNotification = saveNotification;
})();

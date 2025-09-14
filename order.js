document.getElementById("orderForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  const messageBox = document.getElementById("message");

  fetch("send_order.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    messageBox.style.display = "block";
    messageBox.className = "message success";
    messageBox.textContent = "✅ ส่งคำสั่งซื้อสำเร็จแล้ว ขอบคุณที่สั่งซื้อครับ!";
    form.reset();
  })
  .catch(err => {
    messageBox.style.display = "block";
    messageBox.className = "message error";
    messageBox.textContent = "❌ เกิดข้อผิดพลาดในการส่งคำสั่งซื้อ กรุณาลองใหม่อีกครั้ง";
  });
});

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網</title>
    <?php include 'link.php'; ?>
    <?php include 'header.php'; ?>   
    <style>
        #captcha { cursor: pointer; }
        .captcha-container {
            display: flex;
            align-items: center; /* 垂直對齊 */
        }
        .captcha-container button {
            margin-left: 10px; /* 按鈕與圖片之間的距離 */
        }
    </style>
</head>

<body>
    <p></p>
    <h2 class="text-center">網站管理</h2><hr>
    <h3 class="text-center">登入</h3>
    <div id="app" class="container mt-3">
        <form @submit.prevent="submitform">
            <table class="w-50 mx-auto">
                <tr>
                    <td class="form-text"><h4>帳號</h4></td>
                    <td><input type="text" v-model="username" required class="form-control mt-2" size="50"></td>
                </tr>
                <tr>
                    <td class="form-text"><h4>密碼</h4></td>
                    <td><input type="password" v-model="password" required class="form-control mt-2"></td>
                </tr>
                <tr>
                    <td class="form-text"><h4>圖片驗證碼</h4></td>
                    <td>
                        <input type="text" v-model="veri" required class="form-control mt-2" placeholder="請輸入驗證碼">
                        <div class="captcha-container"><br>
                            <canvas id="captcha" width="120" height="50" @click="drawCaptcha"></canvas>
                            <button type="button" class="btn btn-primary" @click="drawCaptcha">重新產生驗證碼</button>
                        </div>
                        <p></p>
                        <button type="submit" class="btn btn-success btn-block">登入</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>    

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        Vue.createApp({
            data() {
                return {
                    username: '',
                    password: '',
                    veri: '',
                    check: ''
                };
            },
            methods: {
                drawCaptcha() {
                    this.check = Array.from({ length: 4 }, () => Math.floor(Math.random() * 10)).join('');
                    const canvas = document.getElementById('captcha');
                    const ctx = canvas.getContext('2d');
                    ctx.fillStyle = '#e6ecfd';
                    ctx.fillRect(0, 0, 120, 50);
                    ctx.font = '30px SimHei';
                    ctx.fillStyle = '#000';
                    ctx.fillText(this.check, 10, 30);
                },
                submitform() {
    const validations = [
        { condition: this.username !== 'admin', message: '帳號錯誤' },
        { condition: this.password !== '1234', message: '密碼錯誤' },
        { condition: this.veri !== this.check, message: '驗證碼錯誤' }
    ];
    for (const validation of validations) {
        if (validation.condition) {
            alert(validation.message);
            return; // 任何檢查失敗時提前返回
        }
    }
    alert("第二圖片驗證");
    location.href = "img.php"; // 登入成功，重定向
}
            },
            mounted() {
                this.drawCaptcha(); // 初始化驗證碼
            }
        }).mount("#app");
    </script>
</body>
</html>

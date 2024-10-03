<!doctype html> 
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>網站管理登入</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.css">
    <script src="./jquery/vue.global.js"></script>
    <script src="./bootstrap/bootstrap.js"></script>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 15px;
        }
        .grid-item {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            cursor: grab;
        }
        .grid-item:active {
            cursor: grabbing;
        }
    </style>
</head>

<body class="bg-light">
    <div id="app" class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="text-center">九宮格拖拉驗證</h3>
                    
                    <!-- 九宮格拖拉驗證部分 -->
                    <div v-if="step === 2" class="mt-3">
                        <h5>請拖動數字，將9宮格正確排列</h5>
                        <div class="grid-container">
                            <div class="grid-item"
                                v-for="(num, index) in grid"
                                :key="index"
                                draggable="true"
                                @dragstart="onDragStart($event, index)"
                                @dragover="onDragOver($event)"
                                @drop="onDrop($event, index)">
                                {{ num }}
                            </div>
                        </div>
                        <button class="btn btn-success mt-3" @click="verifyGrid">確認</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    step: 2, // 直接進入9宮格驗證
                    grid: [], // 9宮格
                    dragStartIndex: null, // 紀錄拖動開始的索引
                };
            },
            methods: {
                generateGrid() {
                    // 生成亂數1~9的9宮格
                    this.grid = [...Array(9).keys()].map(i => i + 1).sort(() => Math.random() - 0.5);
                },
                onDragStart(event, index) {
                    // 記錄拖動開始的索引
                    this.dragStartIndex = index;
                },
                onDragOver(event) {
                    event.preventDefault(); // 允許drop
                },
                onDrop(event, index) {
                    // 交換兩個格子的數字
                    const temp = this.grid[index];
                    this.grid[index] = this.grid[this.dragStartIndex];
                    this.grid[this.dragStartIndex] = temp;
                },
                verifyGrid() {
                    // 驗證9宮格是否正確排序
                    const correctGrid = [...Array(9).keys()].map(i => i + 1);
                    if (JSON.stringify(this.grid) === JSON.stringify(correctGrid)) {
                        alert('登入成功');
                        this.setCookie('login', 'true', 1); // 設定cookie, 登入狀態保存1天
                        window.location.href = 'admin.php';
                    } else {
                        alert('9宮格順序錯誤，請重新排列');
                    }
                },
                setCookie(name, value, days) {
                    let d = new Date();
                    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
                    let expires = "expires=" + d.toUTCString();
                    document.cookie = name + "=" + value + ";" + expires + ";path=/";
                }
            },
            mounted() {
                this.generateGrid(); // 初始化九宮格
            }
        }).mount('#app');
    </script>
</body>

</html>

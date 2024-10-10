<?php include 'link.php';?>
<?php include 'header.php';?>

<div id="app" class="container">
    <h2 class="text-center mt-5 ">新增留言
        <button type="button" class="btn btn-success" data-target="#busModal" data-toggle="modal" @click="openmodal">新增留言</button>
    </h2>
    <div class="modal fade" id="busModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{modaltitle}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitbus">
                        <div class="form-group">
                            <label for="name"><h4>姓名</h4></label>
                            <input type="text" name="name" class="form-control mt-2" required v-model="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email"><h4>電子郵件</h4></label>
                            <input type="email" name="email" class="form-control mt-2" required v-model="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone"><h4>電話</h4></label>
                            <input type="text" name="phone" class="form-control mt-2" required v-model="phone" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="content"><h4>內容</h4></label>
                            <textarea name="content" class="form-control mt-2" required v-model="content" id="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="num"><h5>留言序號</h5></label>
                            <input type="text" name="num" min="0" class="form-control mt-2" required v-model="num" id="num">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">提交</button>
                        <p></p>
                        <a href="admin.php">
                            <div class="btn btn-dark btn-block">回上頁</div>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            <template v-for="entry in entries" :key="entry.id">
                <tr>
                    <td>{{entry.name}}</td>
                    <td>{{entry.content}}</td>
                    <td rowspan="3" align="center">
                        <h4>留言序號</h4>
                        <p></p>（{{entry.num}}）<p></p>
                        <button class="btn btn-warning btn-sm" @click="edit(entry)">編輯</button>&ensp;
                        <button class="btn btn-dark btn-sm" @click="deleteEntry(entry.id)">刪除</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">發表於: {{entry.time}}</td> <!-- 更新為 time -->
                </tr>
                <tr>
                    <td>電子郵件: {{entry.email}}</td>
                    <td>電話: {{entry.phone}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:70px; border: none;"></td> <!-- 增加空行 -->
                </tr>
            </template>
        </tbody>
    </table>
</div>

<script>
    Vue.createApp({
        data() {
            return {
                entries: [],
                name: '',
                email: '',
                phone: '',
                content: '',
                num: '', // 留言序號
                currentEntry: null,
                modaltitle: '新增留言',
            };
        },
        mounted() {
            this.fetchEntries();
        },
        methods: {
            fetchEntries() {
                fetch('./api/bus.php') // 確保此API可以處理新增的字段
                    .then(response => response.json())
                    .then(data => {
                        this.entries = data;
                    });
            },
            submitbus() {
                if (this.currentEntry) {
                    this.updateEntry();
                } else {
                    this.addEntry();
                }
            },
            addEntry() {
                fetch('./api/bus.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        content: this.content,
                        num: this.num, // 包括留言序號
                    })
                })
                .then(response => response.json())
                .then(() => {
                    this.fetchEntries();
                    this.resetForm();
                    $('#busModal').modal('hide');
                });
            },
        
            edit(entry){
                this.currentEntry=entry;
                this.name=entry.name;
                this.email=entry.email;
                this.phone = entry.phone;
                this.content = entry.content;
                this.num = entry.num; // 填入留言序號
                this.modaltitle='編輯留言';
                $('#busModal').modal('show');
            },
            updateEntry() {
                fetch('./api/bus.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: this.currentEntry.id,
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        content: this.content,
                        num: this.num, // 更新留言序號
                    })
                })
                .then(response => response.json())
                .then(() => {
                    this.fetchEntries();
                    this.resetForm();
                    $('#busModal').modal('hide');
                });
            },
            updateEntry(){
                fetch('./api/bus.php',{
                    method:'PUT',
                    header:{
                        'Content-Type':'application/json'
                    },
                    body:JSON.stringify({
                        id: this.currentEntry.id,
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        content: this.content,
                        num: this.num, // 更新留言序號
                    })
                })
                .then(response=>response.json())
                .then(()=>{
                    this.fetchbuses();
                    this.resetForm();
                    $('#busModal').modal('hide');
                });
            },





            deleteEntry(id) {
                fetch('./api/bus.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(() => {
                    this.fetchEntries();
                });
            },
            resetForm() {
                this.name = '';
                this.email = '';
                this.phone = '';
                this.content = '';
                this.num = ''; // 重置留言序號
                this.currentEntry = null;
                this.modaltitle = '新增留言';
            },
            openmodal() {
                this.resetForm();
                $('#busModal').modal('show');
            }
        }
    }).mount("#app");
</script>

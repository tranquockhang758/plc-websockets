
@extends('layouts.admin')
@section('content')
<style>
    .bg-green{
        background: #00b894;
    }
    .bg-blue{
        background: #0984e3;
    }
</style>
<section class="content">
    <div class="container-fluid" id="status-app">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                    <div class="inner">
                        <h3>@{{Prod_GR}}</h3><sup style="font-size: 20px"></sup>
                        <p>Sản phẩm lục</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>@{{Prod_GR}}</h3><sup style="font-size: 20px"></sup>
                        <p>Sản phẩm lục</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>@{{Prod_YE}}</h3>
                        <p>Sản phẩm vàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>@{{Total_Prod}}</h3>
                        <p>Tổng sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                </div>
             <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                    <div class="inner">
                        <h3>@{{Prod_GR_in_box}}</h3><sup style="font-size: 20px"></sup>
                        <p>Sản phẩm lục trong thùng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>@{{Prod_GR_in_box}}</h3><sup style="font-size: 20px"></sup>
                        <p>Sản phẩm lam trong thùng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>@{{Prod_YE_in_box}}</h3>
                        <p>Sản phẩm vàng trong thùng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>@{{Total_Prod_in_box}}</h3>
                        <p>Tổng sản phẩm trong thùng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive shadow-sm rounded bg-white text-center">
                <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                    <th scope="col">Tên thiết bị</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tín hiệu</th>
                    <th scope="col">Đèn báo hiệu</th>
                    <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ======Conveyor in  --}}
                    <tr>
                        <td>Băng chuyền vào</td>
                        <td>
                            <span v-if="Conveyor_IN == 1" class="text-success">Chạy</span>
                            <span v-else class="text-danger">Dừng</span>
                        </td>
                        <td>
                            <span>@{{Conveyor_IN}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="Conveyor_IN === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======Conveyor out  --}}
                    <tr>
                        <td>Băng chuyền ra</td>
                        <td>
                            <span v-if="Conveyor_OUT == 1" class="text-success">Chạy</span>
                            <span v-else class="text-danger">Dừng</span>
                        </td>
                        <td>
                            <span>@{{Conveyor_OUT}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="Conveyor_OUT === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======cylinder green --}}
                    <tr>
                        <td>Xy lanh xanh</td>
                        <td>
                            <span v-if="CYLINDER_GREEN == 1" class="text-success">Chạy</span>
                            <span v-else class="text-danger">Dừng</span>
                        </td>
                        <td>
                            <span :class="CYLINDER_GREEN === 1 ? 'text-on' : 'text-off'">@{{CYLINDER_GREEN}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="CYLINDER_GREEN === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======cylinder blue --}}
                    <tr>
                        <td>Xy lanh lục</td>
                        <td>
                            <span v-if="CYLINDER_BLUE == 1" class="text-success">Chạy</span>
                            <span v-else class="text-danger">Dừng</span>
                        </td>
                        <td>
                            <span :class="CYLINDER_BLUE === 1 ? 'text-on' : 'text-off'">@{{CYLINDER_BLUE}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="CYLINDER_BLUE === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======cylinder yellow --}}
                    <tr>
                        <td>Xy lanh lục</td>
                        <td>
                            <span v-if="CYLINDER_YELLOW == 1" class="text-success">Chạy</span>
                            <span v-else class="text-danger">Dừng</span>
                        </td>
                        <td>
                            <span :class="CYLINDER_YELLOW === 1 ? 'text-on' : 'text-off'">@{{CYLINDER_YELLOW}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="CYLINDER_YELLOW === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======green light --}}
                    <tr>
                        <td>Đèn xanh</td>
                        <td>
                            <span v-if="GREEN_LIGHT == 1" class="text-success">Sáng</span>
                            <span v-else class="text-danger">Tắt</span>
                        </td>
                        <td>
                            <span :class="GREEN_LIGHT === 1 ? 'text-on' : 'text-off'">@{{GREEN_LIGHT}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="GREEN_LIGHT === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======red light --}}
                    <tr>
                        <td>Đèn đỏ</td>
                        <td>
                            <span v-if="RED_LIGHT == 1" class="text-success">Sáng</span>
                            <span v-else class="text-danger">Tắt</span>
                        </td>
                        <td>
                            <span :class="RED_LIGHT === 1 ? 'text-on' : 'text-off'">@{{RED_LIGHT}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="RED_LIGHT === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======yellow light --}}
                    <tr>
                        <td>Đèn vàng</td>
                        <td>
                            <span v-if="YELLOW_LIGHT == 1" class="text-success">Sáng</span>
                            <span v-else class="text-danger">Tắt</span>
                        </td>
                        <td>
                            <span :class="YELLOW_LIGHT === 1 ? 'text-on' : 'text-off'">@{{YELLOW_LIGHT}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="YELLOW_LIGHT === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                    {{-- ======Siren light --}}
                    <tr>
                        <td>Siren</td>
                        <td>
                            <span v-if="SIREN == 1" class="text-success">Sáng</span>
                            <span v-else class="text-danger">Tắt</span>
                        </td>
                        <td>
                            <span :class="SIREN === 1 ? 'text-on' : 'text-off'">@{{SIREN}}</span>
                        </td>
                        <td>
                            <span class="status-dot" :class="SIREN === 1 ? 'status-on' : 'status-off'"></span>
                        </td>
                        <td>@{{time}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
    </div>
</section>
@endsection
@section('scriptsStatus')
<script>
new Vue({
        el: '#status-app',
        data() {
            return {
                Prod_GR:0,
                Prod_BL:0,
                Prod_YE:0,
                Total_Prod:0,
                Conveyor_IN:0,
                Conveyor_OUT:0,
                CYLINDER_GREEN:0,
                CYLINDER_BLUE:0,
                CYLINDER_YELLOW:0,
                GREEN_LIGHT	:0,
                YELLOW_LIGHT:0,
                RED_LIGHT:0,
                SIREN:0,
                Prod_GR_in_box:0,
                Prod_BL_in_box:0,
                Prod_YE_in_box:0,
                Total_Prod_in_box:0,
                time:"",
            };
        },
        methods: {
            processData(data) {
                this.Prod_GR = data.Prod_GR;
                this.Prod_BL = data.Prod_BL;
                this.Prod_YE = data.Prod_YE;
                this.Total_Prod = data.Prod_GR + data.Prod_BL + data.Prod_YE;
                this.Conveyor_IN = data.Conveyor_IN;
                this.Conveyor_OUT = data.Conveyor_OUT;
                this.CYLINDER_GREEN = data.CYLINDER_GREEN;
                this.CYLINDER_BLUE = data.CYLINDER_BLUE;
                this.CYLINDER_YELLOW = data.CYLINDER_YELLOW;
                this.GREEN_LIGHT = data.GREEN_LIGHT;
                this.YELLOW_LIGHT = data.YELLOW_LIGHT;
                this.RED_LIGHT = data.RED_LIGHT;
                this.Prod_BL_in_box = data.Prod_BL_in_box;
                this.Prod_GR_in_box = data.Prod_GR_in_box;
                this.Prod_YE_in_box = data.Prod_YE_in_box;
                this.Total_Prod_in_box = this.Prod_BL_in_box  + this.Prod_GR_in_box + this.Prod_YE_in_box;
                this.SIREN = data.SIREN;
                const utcDate = new Date(data.time);
                const localDate = new Date(utcDate.getTime());
                const timeLabel = localDate.toLocaleString('vi-VN', {
                        year: 'numeric', month: '2-digit', day: '2-digit',
                        hour: '2-digit', minute: '2-digit', second: '2-digit',
                });
                this.time = timeLabel;
                console.log(this.Conveyor_IN);
            },
            async loadInitialData() {
                try {
                    const res = await axios.post('/sendDataToClient',{status:"digital"});
                    if(res.data.code ==200){
                        this.processData(res.data.data);
                    }
                } catch (err) {
                    console.error('Lỗi load dữ liệu:', err);
                }
            },
            //===================listenSocket
            listenSocket() {
                window.Echo.join('python')
                    .listen('NewDataFromPython', (event) => {
                        console.log('event',event);
                        this.processData(event.data,event.allData);
                    });
            }
        },
        //===================listenSocket
        mounted() {
            this.loadInitialData();
            this.listenSocket();
        },
    });
</script>
@endsection

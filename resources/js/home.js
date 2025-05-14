<script>
    new Vue({
          el: '.content-wrapper',
          data() {
            return {
              message:'',
              users: [], // Mảng người dùng
              id: {{  auth()->check() ? auth()-> user()->id : 1 }},
              chartData: [0, 0, 0], // Yellow, Green, Blue
              chartLabels: ['Sản phẩm vàng', 'Sản phẩm xanh', 'Sản phẩm lục'],
              chartColors: ['#f39c12', '#00a65a', '#00c0ef'],
              pieChart: null,

              boxData: [0, 0, 0], // Box_BL, Box_GR, Box_YE
              boxLabels: ['Thùng lục', 'Thùng xanh', 'Thùng vàng'],
              boxColors: ['#3c8dbc', '#00a65a', '#f39c12'],
              chart: null,
              pieChart: null  ,// pieChart

              barChartLabels: [],
              barChartData: [0,0],
              barChart: null,

            };
          },
          methods: {
            renderChart() {
                if (this.chart) {
                    this.chart.data.datasets[0].data = this.chartData;
                    this.chart.update();
                } else {
                    const ctx = document.getElementById('donutChart').getContext('2d');
                    this.chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: this.chartLabels,
                        datasets: [{
                        data: this.chartData,
                        backgroundColor: this.chartColors,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                    });
                }
            },
            renderPieChart() {
            if (this.pieChart) {
                this.pieChart.data.datasets[0].data = this.boxData;
                this.pieChart.update();
            } else {
                const ctx = document.getElementById('pieChart').getContext('2d');
                this.pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: this.boxLabels,
                    datasets: [{
                    data: this.boxData,
                    backgroundColor: this.boxColors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
                });
            }
            },

            renderBarChart() {
                if (this.barChart) {
                    this.barChart.data.labels = this.barChartLabels;
                    this.barChart.data.datasets[0].data = this.barChartData;
                    this.barChart.update();
                } else {
                    const ctx = document.getElementById('barChart').getContext('2d');
                    this.barChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: this.barChartLabels,
                            datasets: [{
                                label: 'Tổng sản phẩm',
                                data: this.barChartData,
                                backgroundColor: '#3c8dbc',
                                fill: false,
                                tension: 0.1 // làm mượt đường cong

                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: {
                                    title: { display: true, text: 'Thời gian' }
                                },
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: 1000,
                                    },
                                    title: { display: true, text: 'Tổng sản phẩm' },
                                }]
                            }
                        }
                    });
                }
            },
             // Lọc dữ liệu
            processData(data,dataAll) {
                const yellow = data.Prod_YE || 0;
                const green = data.Prod_GR|| 0;
                const blue = data.Prod_BL || 0;
                this.chartData = [yellow, green, blue];
                this.renderChart();

                const box_blue = data.Box_BL || 0;
                const box_green = data.Box_GR || 0;
                const box_yellow = data.Box_YE || 0;
                this.boxData = [box_blue, box_green, box_yellow];
                this.renderPieChart();



                this.barChartLabels = [];
                this.barChartData = [];
                dataAll.forEach(item => {
                    const total = (item.Prod_BL || 0) + (item.Prod_GR || 0) + (item.Prod_YE || 0);

                    // Convert UTC -> UTC+7
                    // const rawTime = item.time.replace(/\.\d+Z$/, 'Z'); // Xóa phần .000000 nếu có
                    const utcDate = new Date(item.created_at);
                    const localDate = new Date(utcDate.getTime());
                    const timeLabel = localDate.toLocaleString('vi-VN', {
                        year: 'numeric', month: '2-digit', day: '2-digit',
                        hour: '2-digit', minute: '2-digit', second: '2-digit',
                    });

                    this.barChartLabels.push(timeLabel);
                    this.barChartData.push(total);
                });
                this.renderBarChart();
            },
            //Render Chart
            // Tải dữ liệu ban đầu từ server
            async loadInitialData() {
                try {
                    const res = await axios.get('/sendDataToClient');
                    if(res.data.code==200){
                        // console.log(res.data);
                        this.processData(res.data.data,res.data.dataAll);
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

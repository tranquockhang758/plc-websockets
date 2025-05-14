
@extends('layouts.admin')
@section('content')
<style>
    .filter-area{
        padding: 0px 0px;
        display: flex;
        justify-content: space-between;
    }
    /* .search-div{
        justify-content: flex-start;
    } */
    .button-filter-div{
        display: flex;
        justify-content: right;
    }
    .search{
        position: relative;
    }
    .icon-search{
        position: absolute;
        top: 10px;
        left: 8px;
        color:#95a5a6;
    }
    .input-search{
        padding-left: 25px;
    }
    .dropdown-menu{
        left: -90px;
    }
    .table-status{
        padding-left: 0px;
    }
</style>
<section class="content">
    <div class="container-fluid" id="status-data">
        <div class="row">
                <div class="col-12 filter-area mb-2">
                    {{-- <div class="col-3 mb-2 search-div">
                        <div class="d-flex align-items-center gap-2" style="max-width: 500px;">
                            <div class="flex-grow-1 search">
                              <i class="icon-search fas fa-search "></i>
                              <input
                                type="text"
                                class="form-control ps-5 input-search"
                                placeholder="Tìm kiếm theo ngày"
                                v-model="searchQuery"
                              >
                            </div>

                        </div>
                    </div> --}}
                    <div class="button-filter-div">
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Sort by
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" @click="sortItems('green', 'asc')">Sản phẩm xanh A-Z</a>
                                <a class="dropdown-item" href="#" @click="sortItems('green', 'desc')">Sản phẩm xanh Z-A</a>
                                <a class="dropdown-item" href="#" @click="sortItems('blue', 'asc')">Sản phẩm lục A-Z</a>
                                <a class="dropdown-item" href="#" @click="sortItems('blue', 'desc')">Sản phẩm lục Z-A</a>
                                <a class="dropdown-item" href="#" @click="sortItems('yellow', 'asc')">Sản phẩm vàng A-Z</a>
                                <a class="dropdown-item" href="#" @click="sortItems('yellow', 'desc')">Sản phẩm vàng Z-A</a>
                                <a class="dropdown-item" href="#" @click="sortItems('Total_Prod', 'asc')">Tổng Sản phẩm A-Z</a>
                                <a class="dropdown-item" href="#" @click="sortItems('Total_Prod', 'desc')">Tổng Sản phẩm Z-A</a>
                                <a class="dropdown-item" href="#" @click="sortItems('Total_Box', 'asc')">Tổng thùng A-Z</a>
                                <a class="dropdown-item" href="#" @click="sortItems('Total_Box', 'desc')">Tổng thùng Z-A</a>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="col-12 table-status">
                    <table id="tableExport" class="text-center table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Sản phẩm xanh</th>
                                <th>Sản phẩm lục</th>
                                <th>Sản phẩm vàng</th>
                                <th>Thùng xanh</th>
                                <th>Thùng lục</th>
                                <th>Thùng vàng</th>
                                <th>Tổng sản phẩm</th>
                                <th>Tổng thùng</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in paginatedItems" :key="index">
                                <td>@{{ index +1 }}</td>
                                <td>@{{ item.Prod_GR }}</td>
                                <td>@{{ item.Prod_BL }}</td>
                                <td>@{{ item.Prod_YE }}</td>
                                <td>@{{ item.Box_GR }}</td>
                                <td>@{{ item.Box_BL }}</td>
                                <td>@{{ item.Box_YE }}</td>
                                <td>@{{ item.Total_Prod }}</td>
                                <td>@{{ item.Total_Box }}</td>
                                <td>@{{ item.created_at_local }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            {{-- << 1 ... 4 5 [6] 7 8 ... 100 >> --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Page @{{ currentPage }} of @{{ totalPages }}</div>
                                {{-- <nav aria-label="Page navigation" class="mt-3">
                                    <ul class="pagination justify-content-center">
                                      <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" href="" @click.prevent="changePage(currentPage - 1)">
                                          <span aria-hidden="true">&laquo;</span>
                                          <span class="sr-only">Previous</span>
                                        </a>
                                      </li>

                                      <li class="page-item"
                                          v-for="page in totalPages"
                                          :key="page"
                                          :class="{ active: currentPage === page }">
                                        <a class="page-link" href="" @click.prevent="changePage(page)">@{{ page }}</a>
                                      </li>

                                      <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" href="" @click.prevent="changePage(currentPage + 1)">
                                          <span aria-hidden="true">&raquo;</span>
                                          <span class="sr-only">Next</span>
                                        </a>
                                      </li>
                                    </ul>
                                </nav> --}}
                                <nav aria-label="Page navigation" class="mt-3">
                                    <ul class="pagination justify-content-center">
                                      <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">&laquo;</a>
                                      </li>

                                      <li class="page-item"
                                          v-for="page in paginationPages"
                                          :key="page"
                                          :class="{ active: page === currentPage, disabled: page === '...' }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(page)">
                                          @{{ page }}
                                        </a>
                                      </li>

                                      <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">&raquo;</a>
                                      </li>
                                    </ul>
                                  </nav>
                            </div>
                        </tfoot>
                    </table>
                </div>
        </div>
    </div>
</section>
@endsection
@section('exportData')
<script>
new Vue({
        el: '#status-data',
        data() {
            return {
                items: [],
                    searchQuery: "",
                    showFilter: false,
                    sortKey: null,
                    sortOrder: 'asc',
                    currentPage: 1,
                    perPage: 50,
                };
        },
        methods: {
            //Lấy sự kiện khi click vào paginate change page
            changePage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                }
            },
            //Trả về biến sortKey là loại sort gì
            sortItems(color, order) {
                this.sortOrder = order;
                switch (color) {
                    case 'green':
                        this.sortKey = 'Prod_GR';
                        break;
                    case 'blue':
                        this.sortKey = 'Prod_BL';
                        break;
                    case 'yellow':
                        this.sortKey = 'Prod_YE';
                        break;
                    case 'Total_Prod':
                        this.sortKey = 'Total_Prod';
                        break;
                    case 'Total_Box':
                        this.sortKey = 'Total_Box';
                        break;
                    default:
                        this.sortKey = null;
                }
            },
            processData(data) {
                this.items = data.map(item => {
                        const utcDate = new Date(item.created_at);
                        const localDate = new Date(utcDate.getTime() + (7 * 60 * 60 * 1000)); // cộng 7 giờ
                        return {
                            ...item,
                            created_at_local: localDate.toISOString().slice(0, 19).replace('T', ' '),
                            Total_Prod: item.Prod_BL + item.Prod_GR + item.Prod_YE,
                            Total_Box: item.Box_GR + item.Box_BL + item.Box_YE,
                        };
                });
            },
            async loadInitialData() {
                try {
                    const res = await axios.post('/sendDataToClient',{status:"filter"});
                    if(res.data.code ==200){
                        const data = res.data.data;
                        this.processData(data);

                    }
                } catch (err) {
                    console.error('Lỗi load dữ liệu:', err);
                }
            },
            //===================listenSocket
            listenSocket() {
                window.Echo.join('python')
                    .listen('NewDataFromPython', (event) => {
                        this.processData(event.dataAll);
                    });
            },

            //Hàm để tạo ra việc phân trạng có tích hợp dấu ...
            //Dấu ... chỉ xuất hiện nếu có nhiều trang bị che đi giữa.
            getPagination(current, total, delta = 2) {
                const range = [];
                //`range`: chứa các trang "ở giữa" gần currentPage (VD: [4, 5, 6, 7, 8])
                const pages = [];
                // `pages`: là mảng kết quả cuối cùng bạn sẽ render ra (VD: [1, '...',3, 4, 5, 6, 7, 8, '...', 10])

                // Tạo khoảng giữa currentPage - delta đến currentPage + delta
                for (let i = Math.max(2, current - delta); i <= Math.min(total - 1, current + delta); i++) {
                range.push(i);  
                }

                // Nếu có khoảng cách giữa trang đầu và dãy range, thêm 1 và '...'
                //Trang 5 hiện dấu ...
                if (current - delta > 2) {
                pages.push(1, '...');
                } else {
                for (let i = 1; i < Math.max(2, current - delta); i++) {
                    pages.push(i);
                }
                }
                //Mục đích: Tạo các trang ở giữa, từ currentPage - delta đến
                // currentPage + delta, nhưng không chạm vào trang 1 và trang cuối cùng (total)
                //Ví dụ với current = 6, delta = 2, total = 10:
                //Math.max(2, 6 - 2) = 4
                //Math.min(9, 6 + 2) = 8

                // Thêm các trang nằm trong vùng "gần currentPage"
                pages.push(...range);
                // Nếu có khoảng cách với trang cuối, thêm '...' và total
                if (current + delta < total - 1) {
                pages.push('...', total);
                } else {
                for (let i = current + delta + 1; i <= total; i++) {
                    pages.push(i);
                }
                }
                return pages;
            },
            goToPage(page) {
                if (page !== '...') {
                this.currentPage = page;
                }
            },
        },
        //===================listenSocket
        mounted() {
            this.loadInitialData();
            this.listenSocket();
        },
        computed: {
            paginatedItems() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.filteredItems.slice(start, end);
            },
            totalPages() {
                return Math.ceil(this.filteredItems.length / this.perPage);
            },
            filteredItems() {
                let filtered = this.items;
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(item => {
                        return (
                            String(item.Prod_GR).includes(query) ||
                            String(item.Prod_BL).includes(query) ||
                            String(item.Prod_YE).includes(query) ||
                            String(item.Box_GR).includes(query) ||
                            String(item.Box_BL).includes(query) ||
                            String(item.Box_YE).includes(query) ||
                            String(item.created_at_local).toLowerCase().includes(query)
                        );
                    });
                }
                if (this.sortKey) {
                    filtered = filtered.slice().sort((a, b) => {
                        const valA = Number(a[this.sortKey]) || 0;
                        const valB = Number(b[this.sortKey]) || 0;
                        return this.sortOrder === 'asc' ? valA - valB : valB - valA;
                    });
                }
                return filtered;
            },
            paginationPages() {
                return this.getPagination(this.currentPage, this.totalPages);
            }
        }
    });
</script>
@endsection

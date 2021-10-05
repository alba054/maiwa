<div>

    <!-- Row-1 -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total Sales</p>
                    <h2 class="mb-1 number-font">$3,257</h2>
                    <small class="fs-12 text-muted">Compared to Last Month</small>
                    <span class="ratio bg-warning">76%</span>
                    <span class="ratio-text text-muted">Goals Reached</span>
                </div>
                <div id="spark1"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total User</p>
                    <h2 class="mb-1 number-font">1,678</h2>
                    <small class="fs-12 text-muted">Compared to Last Month</small>
                    <span class="ratio bg-info">85%</span>
                    <span class="ratio-text text-muted">Goals Reached</span>
                </div>
                <div id="spark2"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1 ">Total Income</p>
                    <h2 class="mb-1 number-font">$2,590</h2>
                    <small class="fs-12 text-muted">Compared to Last Month</small>
                    <span class="ratio bg-danger">62%</span>
                    <span class="ratio-text text-muted">Goals Reached</span>
                </div>
                <div id="spark3"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden dash1-card border-0">
                <div class="card-body">
                    <p class=" mb-1">Total Tax</p>
                    <h2 class="mb-1 number-font">$1,954</h2>
                    <small class="fs-12 text-muted">Compared to Last Month</small>
                    <span class="ratio bg-success">53%</span>
                    <span class="ratio-text text-muted">Goals Reached</span>
                </div>
                <div id="spark4"></div>
            </div>
        </div>
    </div>
    <!-- End Row-1 -->

    <!-- Row-2 -->
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Analysis</h3>
                    <div class="card-options">
                        <div class="btn-group p-0">
                            <button class="btn btn-outline-light btn-sm" type="button">Week</button>
                            <button class="btn btn-light btn-sm" type="button">Month</button>
                            <button class="btn btn-outline-light btn-sm" type="button">Year</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-3 col-6">
                            <p class="mb-1">Total Sales</p>
                            <h3 class="mb-0 fs-20 number-font1">$52,618</h3>
                            <p class="fs-12 text-muted"><span class="text-danger mr-1"><i
                                        class="fe fe-arrow-down"></i>0.9%</span>this month</p>
                        </div>
                        <div class="col-xl-3 col-6 ">
                            <p class=" mb-1">Maximum Sales</p>
                            <h3 class="mb-0 fs-20 number-font1">$26,197</h3>
                            <p class="fs-12 text-muted"><span class="text-success mr-1"><i
                                        class="fe fe-arrow-up"></i>0.15%</span>this month</p>
                        </div>
                        <div class="col-xl-3 col-6">
                            <p class=" mb-1">Total Units Sold</p>
                            <h3 class="mb-0 fs-20 number-font1">13,876</h3>
                            <p class="fs-12 text-muted"><span class="text-danger mr-1"><i
                                        class="fe fe-arrow-down"></i>0.8%</span>this month</p>
                        </div>
                        <div class="col-xl-3 col-6">
                            <p class=" mb-1">Maximum Units Sold</p>
                            <h3 class="mb-0 fs-20 number-font1">5,876</h3>
                            <p class="fs-12 text-muted"><span class="text-success mr-1"><i
                                        class="fe fe-arrow-up"></i>0.06%</span>this month</p>
                        </div>
                    </div>
                    <div id="echart1" class="chart-tasks chart-dropshadow text-center"></div>
                    <div class="text-center mt-2">
                        <span class="mr-4"><span class="dot-label bg-primary"></span>Total Sales</span>
                        <span><span class="dot-label bg-secondary"></span>Total Units Sold</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                    <div class="card-options">
                        <a href="{{ url('/' . ($page = '#')) }}" class="option-dots" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Today</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Week</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Month</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="latest-timeline scrollbar3" id="scrollbar3">
                        <ul class="timeline mb-0">
                            <li class="mt-0">
                                <div class="d-flex"><span class="time-data">Task Finished</span><span
                                        class="ml-auto text-muted fs-11">09 June 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Joseph Ellison</span> finished
                                    task
                                    on<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold"> Project
                                        Management</a></p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">New Comment</span><span
                                        class="ml-auto text-muted fs-11">05 June 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Elizabeth Scott</span> Product
                                    delivered<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                        Service
                                        Management</a></p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">Target Completed</span><span
                                        class="ml-auto text-muted fs-11">01 June 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Sonia Peters</span> finished
                                    target
                                    on<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold"> this
                                        month
                                        Sales</a></p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">Revenue Sources</span><span
                                        class="ml-auto text-muted fs-11">26 May 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Justin Nash</span> source
                                    report
                                    on<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                        Generated</a>
                                </p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">Dispatched Order</span><span
                                        class="ml-auto text-muted fs-11">22 May 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Ella Lambert</span> ontime
                                    order
                                    delivery <a href="{{ url('/' . ($page = '#')) }}"
                                        class="font-weight-semibold">Service
                                        Management</a></p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">New User Added</span><span
                                        class="ml-auto text-muted fs-11">19 May 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Nicola Blake</span> visit the
                                    site<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                        Membership
                                        allocated</a></p>
                            </li>
                            <li>
                                <div class="d-flex"><span class="time-data">Revenue Sources</span><span
                                        class="ml-auto text-muted fs-11">15 May 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Richard Mills</span> source
                                    report
                                    on<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                        Generated</a>
                                </p>
                            </li>
                            <li class="mb-0">
                                <div class="d-flex"><span class="time-data">New Order Placed</span><span
                                        class="ml-auto text-muted fs-11">11 May 2020</span></div>
                                <p class="text-muted fs-12"><span class="text-info">Steven Hart</span> is proces
                                    the
                                    order<a href="{{ url('/' . ($page = '#')) }}" class="font-weight-semibold">
                                        #987</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-2 -->

    <!--Row-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Product Sales Overview</h3>
                    <div class="card-options">
                        <a href="{{ url('/' . ($page = '#')) }}" class="option-dots" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Today</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Week</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Month</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = '#')) }}">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap mb-0 table-striped table-bordered border-top">
                            <thead
                                class="">
                                <tr>
                                    <th>Product</th>
                                    <th>Sold</th>
                                    <th>Record point</th>
                                    <th>Stock</th>
                                    <th>Amount</th>
                                    <th>Stock Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="
                                font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                    src="{{ URL::asset('assets/images/orders/7.jpg') }}" alt="media1"> New
                                Book
                                </td>
                                <td><span class="badge badge-primary">18</span></td>
                                <td>05</td>
                                <td>112</td>
                                <td class="number-font">$ 2,356</td>
                                <td><i class="fa fa-check mr-1 text-success"></i> In Stock</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/8.jpg') }}" alt="media1"> New
                                        Bowl
                                    </td>
                                    <td><span class="badge badge-info">10</span></td>
                                    <td>04</td>
                                    <td>210</td>
                                    <td class="number-font">$ 3,522</td>
                                    <td><i class="fa fa-check text-success"></i> In Stock</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/9.jpg') }}" alt="media1"> Modal
                                        Car</td>
                                    <td><span class="badge badge-secondary">15</span></td>
                                    <td>05</td>
                                    <td>215</td>
                                    <td class="number-font">$ 5,362</td>
                                    <td><i class="fa fa-check text-success"></i> In Stock</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/10.jpg') }}" alt="media1">
                                        Headset
                                    </td>
                                    <td><span class="badge badge-primary">21</span></td>
                                    <td>07</td>
                                    <td>102</td>
                                    <td class="number-font">$ 1,326</td>
                                    <td><i class="fa fa-check text-success"></i> In Stock</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/12.jpg') }}" alt="media1"> Watch
                                    </td>
                                    <td><span class="badge badge-danger">34</span></td>
                                    <td>10</td>
                                    <td>325</td>
                                    <td class="number-font">$ 5,234</td>
                                    <td><i class="fa fa-check text-success"></i> In Stock</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/13.jpg') }}" alt="media1">
                                        Branded
                                        Shoes</td>
                                    <td><span class="badge badge-success">11</span></td>
                                    <td>04</td>
                                    <td>0</td>
                                    <td class="number-font">$ 3,256</td>
                                    <td><i class="fa fa-exclamation-triangle text-warning"></i> Out of stock</td>
                                </tr>
                                <tr class="mb-0">
                                    <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                            src="{{ URL::asset('assets/images/orders/11.jpg') }}" alt="media1"> New
                                        EarPhones</td>
                                    <td><span class="badge badge-warning">60</span></td>
                                    <td>10</td>
                                    <td>0</td>
                                    <td class="number-font">$ 7,652</td>
                                    <td><i class="fa fa-exclamation-triangle text-danger"></i> Out of stock</td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End row-->
</div>

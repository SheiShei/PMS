<template>
    <section class="main-main-container" style="">

        <div class="title-head">
            <h2><span class="fa fa-suitcase"></span> Brands <small>Panel</small></h2>
        </div>

        <div class="first-column col-md-8 col-sm-12"> 
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>SUMMARY</strong></h6>
                </div>
                <div class="mybox-body">
                    <div class="mycard mycard-full-info">
                        <div class="mc-head">
                            <p>ON SERVICE</p>
                        </div>
                        
                        <div class="mc-body">
                            <div class="mc-icon">
                                <i class="fa fa-folder-open-o"></i>
                            </div>
                            <div class="mc-num">
                                <h3 class="">53</h3>
                            </div>
                        </div>
                    </div>
                    <div class="mycard mycard-full-danger">
                        <div class="mc-head">
                            <p> CLOSED </p>
                        </div>
                        
                        <div class="mc-body">
                            <div class="mc-icon">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <div class="mc-num">
                                <h3 class="">50</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mycard mycard-full-success">
                            <div class="mc-head">
                                <p> TOTAL </p>
                            </div>
                            
                            <div class="mc-body">
                                <div class="mc-icon">
                                    <i class="fa fa-copy"></i>
                                </div>
                                <div class="mc-num">
                                    <h3 class="">175</h3>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>BRANDS OVERVIEW</strong></h6>
                </div>
                <div class="mybox-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Sort by:</span>
                                <select class="my-input" name="" id="">
                                    <option value="">Name (A - Z)</option>
                                    <option value="">Name (Z - A)</option>
                                    <option value="">Date (Ascending)</option>
                                    <option value="">Date (Descending)</option>
                                </select>
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="search" class="my-input" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive" style="margin-top: 10px; max-height: 35vh; overflow:auto">
                    
                        
                        <table class="table table-bordered table-brands">
                            <thead>
                                <th>ID</th>
                                <th>Brand Name</th>
                                <th>Deadline</th>
                                <th>Total JO</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Furnitalia</td>
                                    <td>Dec. 7, 2018</td>
                                    <td>9</td>
                                    <td class="td-actions">
                                        <router-link :to="{name: 'brand_profile'}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mowelfund</td>
                                    <td>Sept. 15, 2018</td>
                                    <td>18</td>
                                    <td class="td-actions">
                                        <router-link :to="{name: 'brand_profile'}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Fil-Global</td>
                                    <td>March. 2, 2016</td>
                                    <td>67</td>
                                    <td class="td-actions">
                                        <router-link :to="{name: 'brand_profile'}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Potato Corner</td>
                                    <td>Jan. 10, 2017</td>
                                    <td>2</td>
                                    <td class="td-actions">
                                        
                                        <!-- <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </button> -->
                                        <router-link :to="{name: 'brand_profile'}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Allele White</td>
                                    <td>Feb. 12, 2018</td>
                                    <td>7</td>
                                    <td class="td-actions">
                                        <router-link :to="{name: 'brand_profile'}" type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="View">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="mybox-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <router-link :to="{name: 'new_brand'}" class="btn btn-sm btn-info pull-right">+ New Brand</router-link>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="sec-column col-md-4 col-sm-12">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>ACTIVE JOB ORDERS</strong></h6>
                </div>
                <div class="mybox-body white-bg">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="jo-list">
                                <li>
                                    <router-link :to="{name: 'jo', params: {id: 'mfi-revision'}}">
                                        <span class="fa fa-file-o"></span>
                                        [090718] MFI Revision
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'jo', params: {id: 'furnitalia-revision'}}">
                                        <span class="fa fa-file-o"></span>
                                        [102518] Furnitalia Revision
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'jo', params: {id: 'fil-revision'}}">
                                        <span class="fa fa-file-o"></span>
                                        [031318] Fil Revision
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'jo', params: {id: 'mowel-revision'}}">
                                        <span class="fa fa-file-o"></span>
                                        [031318] Mowel Revision
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'jo', params: {id: 'policious-revisio'}}">
                                        <span class="fa fa-file-o"></span>
                                        [031318] Policious Revision
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div> 
                <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <router-link :to="{name: 'all_jo_list'}" class="btn btn-sm btn-info btn-md btn-simple">See All Job Order Forms</router-link>
                        </div>
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>                                     
            </div>
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>NEW JOB ORDER</strong></h6>
                </div>
                <div class="mybox-body white-bg">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="note">Select a JO type to create new Job Order form.</p>
                            <!-- <div class="form-group">
                                <div class="btn-group bootstrap-select">
                                    <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option selected disabled="">-- JO Form Type --</option>
                                        <option value="">JO (Web)</option>
                                        <option value="">JO (Creatives)</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_web'}" type="button" rel="tooltip" class="btn btn-info btn-xs full-btn">
                                        Web JO
                                    </router-link>
                                </div>
                                <div class="col-md-6">
                                    <router-link :to="{name: 'new_jo_creative'}" type="button" rel="tooltip" class="btn btn-info btn-xs full-btn">
                                        Creatives JO
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                <!-- <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <router-link :to="{name: 'new_jo_web'}" class="btn btn-sm btn-info btn-md">+ Create New JO</router-link>
                        </div>
                    </div>
                </div>                                      -->
            </div>
        </div>

    </section>
</template>

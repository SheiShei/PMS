<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-user-o"></span> Job Orders <small>List</small></h2>
        </div>
        <div class="col-md-9">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>JOB ORDERS LIST</strong></h6>
                </div>
                <div class="mybox-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Sort by:</span>
                                <select class="my-input" name="" id="">
                                    <option value="">Date (Descending)</option>
                                    <option value="">Date (Ascending)</option>
                                    <option value="">Name (Ascending)</option>
                                    <option value="">Name (Descending)</option>
                                </select>
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="search" class="my-input" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive" style="margin-top: 10px; height: 60vh; overflow:auto">
                        <table class="table table-bordered table-brands">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="">Date Created</th>
                                    <th>Title</th>
                                    <th>Team</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="height: 10vh; overflow:auto">
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>May 5, 2018</td>
                                    <td>MFI Revisions - Apply Mock-ups</td>
                                    <td>Web</td>
                                    <td><span class="label label-warning">In Progress</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>April 10, 2017</td>
                                    <td>Potato Corner - Improve Fries Shots</td>
                                    <td>Creatives</td>
                                    <td><span class="label label-info">New</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>December 5, 2017</td>
                                    <td>Potato Corner - Color Scheme</td>
                                    <td>Creatives</td>
                                    <td><span class="label label-default">Blocked</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>June 25, 2018</td>
                                    <td>Fil-Global Revisions - Change Banner</td>
                                    <td>Web</td>
                                    <td><span class="label label-success">Done</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>May 5, 2018</td>
                                    <td>MFI Revisions - Apply Mock-ups</td>
                                    <td>Web</td>
                                    <td><span class="label label-warning">In Progress</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>April 10, 2017</td>
                                    <td>Potato Corner - Improve Fries Shots</td>
                                    <td>Creatives</td>
                                    <td><span class="label label-info">New</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple btn-xs" data-original-title="" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple btn-xs" data-original-title="" title="Archive">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>June 25, 2018</td>
                                    <td>Furnitalia Revisions - Change Banner</td>
                                    <td>Web</td>
                                    <td><span class="label label-success">Done</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-xs" data-original-title="" title="Open">
                                            <i class="fa fa-eye"></i>
                                        </button>
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

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mybox">
                <div class="mybox-head">
                    <h6><strong>NEW JOB ORDER</strong></h6>
                </div>
                <div class="mybox-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="note">Select a JO type to create a new Job Order form.</p>
                            <div class="form-group">
                                <select class="selectpicker" ref="shei" data-style="btn btn-sm btn-info btn-simple" type="text">
                                    <option disabled="">-- JO Form Type --</option>
                                    <option value="web">JO (Web)</option>
                                    <option value="creatives">JO (Creatives)</option>
                                </select>
                            </div>
                        </div>
                                    
                    </div> 
                </div>
                <div class="mybox-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <router-link :to="{name: 'new_jo_creative'}" class="btn btn-sm btn-info btn-md">+ Create New JO</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .userslist{
        justify-contents: space-evenly;
    }
    .userlist-ft{
        justify-contents: center !important;
    }
    .ul-item{
        display: inline-block !important;
    }
    .ul-item > input span {
        display: block !important;
    }
</style>

<script>
export default {
    updated () {
        // $(this.$refs.select).selectpicker('refresh')
        // let sel  = this.$refs.select;
        // console.log(this.$refs);
        console.log('updated');
	}
}
</script>



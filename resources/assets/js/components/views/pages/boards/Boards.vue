<template>
    <section class="main-main-container" style="background-color: whitesmoke;">
        <div class="col-md-1"></div> 
        <div class="first-column col-md-6">
            <h3 class=""><span class="fa fa-trello"></span> Boards</h3>
            <select name="" id="" class="my-input">
                <option value="employee" selected>All Boards</option> 
                <option value="employee">Scrum</option> 
                <option value="client">Kanban</option>
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name="" id="" class="my-input">
                <option value="">Team & Personal</option> 
                <option value="admin">Team</option> 
                <option value="acma">Personal</option> 
            </select>
            <p class="pull-right">Found: 1 board</p>
            <hr />
            <div class="boardlist" style="max-height: 70vh; overflow-y:auto">
                <a href="/boards/kanban" class="boarddiv">
                    <div class="boardname">Board 1</div>
                    <div class="boardoptions">
                        <p><span class="">
                            <a class="text-success" title="Delete Board"><i class="fa fa-edit"></i></a>
                            <a class="text-danger" title="Close"><i class="fa fa-trash-o"></i></a>
                        </span></p>
                    </div>
                </a>
                <a href="" class="boarddiv">
                    <div class="boardname">Board 1 <span class="fa fa-lock"></span></div>
                    <div class="boardoptions">
                        <p><span class="">
                            <a class="text-success" title="Delete Board"><i class="fa fa-edit"></i></a>
                            <a class="text-danger" title="Close"><i class="fa fa-trash-o"></i></a>
                        </span></p>
                    </div>
                </a>               
            </div>
        </div>
        <div class="col-md-4 profilesec">
            <br/>
            <transition name="slide">
                <div class="mybox">
                    <div class="mybox-head">
                        <h6><strong>NEW BOARD</strong></h6>
                    </div>
                    <div class="mybox-body white-white-bg">
                        <div class="radio">
                            <p for="">Type:
                                <span>
                                    <label>
									    <input type="radio" name="optionsRadios" checked="true"><span class="circle"></span><span class="check"></span>
									    Kanban
								    </label>
                                </span>
                                <span>
                                    <label>
									    <input type="radio" name="optionsRadios" checked="true"><span class="circle"></span><span class="check"></span>
									    Scrum
								    </label>
                                </span>
                            </p>
						</div>
                        <p for="">Name: 
                            <span>
                                <input type="text" class="my-input my-inp-blk">
                            </span>
                        </p>
                        <p for="">Share: 
                            <span>
                                <select name="" id="" class="my-input my-inp-blk">
                                    <option value="employee" selected>Only Me</option> 
                                    <option value="employee">All</option> 
                                    <option value="employee">Web</option> 
                                    <option value="client">Creatives</option>
                                    <option value="client">Custom</option>
                                </select>
                            </span>
                        </p>
                        <div>
                            <div class="form-group">
                                <input  @input="search()" type="search" style="width: 100%; margin-top: 10px" placeholder="Search..." class="my-input">
                            </div>
                            <div class="choose-mem" style="max-height: 130px; overflow:auto">
                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" >
                                        <span class="check">Angelo</span>
                                    </label>
                                </div>
                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" >
                                        <span class="check">Carlo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mybox-footer">
                        <div class="row form-group text-center">
                            <div class="col-md-6">
                                <button  class="btn btn-danger btn-sm btn-block" type="button">CANCEL</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-sm btn-block" type="button" value="">CREATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <div class="col-md-1"></div>
    </section>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
    .boarddiv{
        position: relative;
        display: block;
        padding: 7px 10px;
    }
    .boarddiv:hover{
        background-color: white;
    }
    .boarddiv:hover .boardoptions{
        display: inline-block;
        transition-delay: opacity 0.3s;
    }
    .boardoptions{
        display: none;
        margin-left: 7px;
        font-size: 15px;
        color:unset;
        p{
            margin-bottom: 0;
        }
        a{
            padding: 4px 3px;
        }
    }
    .boardname{
        display: inline-block;
        color: gray;
    }
</style>



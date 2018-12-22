<template>
    <transition name="fade">            
        <div class="overlay">
            <div class="newTaskForm" style="">
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="fa fa-tasks"></span> NEW TASK: </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <router-link :to="{ name: 'kanboard'}" class="btn btn-simple btn-close"><i class="fa fa-close"></i></router-link> 
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Task Name: </label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class=" my-input my-inp-blk">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Desc: </label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="my-text-area my-inp-blk" rows="4"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Attach File/s: </label>
                    </div>
                    <div class="col-md-9">
                        <input type="file" class="my-input my-inp-blk" multiple>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Assign To: </label>
                        <select class="my-input my-inp-blk" >
                            <option value="">Unassign</option>
                            <option value="">RJ</option>
                            <option value="">Shooky</option>
                            <option value="">Tata</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Points: </label>
                        <input type="number" class="my-input my-inp-blk" value="0" min="0">
                    </div>
                    <div class="col-md-4">
                        <label for="">Due: </label>
                        <input type="date" class="my-input my-inp-blk">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-danger btn-block">Cancel</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success btn-block">Add to Board</button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

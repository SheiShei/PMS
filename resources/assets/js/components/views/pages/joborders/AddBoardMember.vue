<template>
    <transition name="fade">
        <div class="overlay">
            <div class="membersmod">
                <div class="row">
                    <div class="col-md-12">
                        <h4>New Member</h4>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <label class="control-label text-grey">
                                <span class="fa fa-user-plus text-left"></span> New Member:</label>
                            <input type="search" style="height: 28px; margin-top: 7px" placeholder="Search..." class="my-input">
                            <span><button @click.prevent="addNotMember" class="btn btn-info btn-sm">
                                ADD SELECTED
                            </button></span>
                        </div>
                        <div class="choose-mem" style="">
                            <div class="checkbox" v-for="member in notmember" :key="member.id">
                                <label>
                                    <input v-model="ids" :value="board_id ? member.id : member" type="checkbox" name="optionsCheckboxes">
                                    <span class="check"></span>
                                    <img :src="member.picture" class="small-avatar"/> {{ member.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <p v-if="false" class="text-success"><span class="fa fa-check"></span> A new member has been successfully added.</p>
                        <!--<p class="text-danger"><span class="fa fa-times"></span> There's a problem adding the member.</p>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button @click="$emit('close')" class="btn btn-xs btn-danger btn-simple">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: ['notmember', 'board_id'],
    data() {
        return {
            ids: []
        }
    },
    methods: {
        addNotMember() {
            if(this.board_id) {
                // console.log(this.ids);
                axios.post('/api/addBoardMemberJO', {ids: this.ids, board_id: this.board_id})
                    .then(response => {
                        // console.log(response);
                        this.$emit('refreshBoardMembers', response.data)
                        this.$emit('close');
                    })
            }
            else {
                // console.log(this.ids);
                this.$emit('addedIds', this.ids)
                this.$emit('close');
            }
        }
    }
}
</script>

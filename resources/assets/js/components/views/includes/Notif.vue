<template>
    <div class="notifwrapper">
    <!-- <button class="" @click="showNotif=!showNotif">Show notif</button> -->
    <!-- <button class="" @click="newNotif">New Notif</button> -->
    <transition-group name="list-complete">
        <div v-for="(notif,index) in notifs" :key="index" class="list-complete-item">
            <router-link v-if="notif.message" :to="notif.action" tag="div" class="notif-indiv shadow list-complete-item">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <img src="/images/default.png" class="large-avatar"/>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <p class="txt-bold no-margin notif-high"><span class="fa fa-envelope-o"></span> {{ notif.sender }}: </p>
                        <p class=""><span>{{ notif.message.text.slice(0, 100) + '...' }}</span></p>                        
                    </div>
                </div>
                <!-- <p>{{notif.name}}</p> -->
                <button @click.prevent="closeNotif(this.index)" type="button" class="notif-close"><i class="fa fa-times"></i></button>
            </router-link>

            <router-link v-else :to="notif.action" tag="div" class="notif-indiv shadow list-complete-item">
                <div class="notifnotifdiv">
                    <div class="notif-left">
                        <div :class="notif.color">
                            <i :class="notif.icon" alt=""></i>
                    </div>
                    </div>
                    <div class="notif-right">
                        <p>{{ notif.text }}</p>
                    </div>
                </div>
                
                
                <!-- <p>{{notif.name}}</p> -->
                <button @click.prevent="closeNotif(this.index)" type="button" class="notif-close"><i class="fa fa-times"></i></button>
            </router-link>
        </div>
    </transition-group>
    </div>
</template>
<script>
export default {
    props: ['notifs'],
    data(){
        return{
            showNotif: false,
            // notifs: [{
            //     name:'Notif 1',
            //     link:''
            // },
            // {
            //     name:'Notif2',
            //     link:''
            // },
            // {
            //     name:'Notif3',
            //     link:''
            // }]
        }
    },
    methods:{
        newNotif(){
            this.notifs.push({
                name: 'Notif',
                link: ''
            })
        },
        closeNotif(index){
            this.notifs.splice(this.index, 1);
            // window.alert("Notif will be deleted.")
        }
    }
}
</script>

<style lang="scss" scoped>
@media only screen and (max-width: 767px){
    .notifwrapper{
        width: 100vw !important;
    }
}
.notif-high{
        font-weight:700;
        color: #fff;
}
.notif-high-msg{
        font-weight:700;
        color: rgb(98, 221, 255);
}
.notifwrapper{
    display: block;
    position: fixed;
    top: 0;
    width: 30vw;
    // max-height: 100vh;
    right: 0;
    padding: 20px;
    // margin-right: 20px;
    float: right;
    background-color: none;
    z-index: 3200000;
}
.notif-indiv{
    width: 100%;
    display: block;
    position: relative;
    margin-right: 20px;
    // width: 100px;
    // height: 30px;
    padding: 15px 20px;
    // background-color: rgb(76, 194, 230); 
    background-color: #214854;
    opacity: 0.9;
    // color: rgb(56, 56, 56);
    color:white;
    margin-bottom: 5px;
    cursor: pointer;
}
.notif-close{
    position: absolute;
    top: 0;
    right: 0px;
    padding: 3px 8px;
    color: white;
    margin: 5px;
    background:none;
    box-shadow: none;
    border: none;
    line-height: 20x;
    border-radius: 50%;
    // content: '\f00d';
    float: right;
    transition: background-color 0.1s ease-in-out;
    -webkit-transition: background-color 0.1s ease-in-out;
    -moz-transition: background-color 0.1s ease-in-out;

}
// .notif-close:focus,
.notif-close:hover{
    background-color: rgb(112, 129, 129);
}

.notifnotifdiv{
  display: flex;
  width: 100%;
  transition: 0.3s ease-in-out;
  cursor: pointer;
  .notif-left{
      display: inline-block;
      padding: 3px;
      // width: 30%;
      .notif-icon{
          height: 34px;
          width: 34px;
          padding: 7px 2px;
          // background-color: goldenrod;
          border-radius: 50%;
          text-align: center;
          i{
              font-size: 15px;
              color:#fff;
          }
      }
  }
  .notif-right{
      display: inline-block;
      padding: 7px;
      p{
          margin: 0;
      }
      // width: 70%;
  }
}
</style>

<template>
    <div class="login-page">
        <div v-if="error" class="alert-messages " id="message-drawer" style="top: 0;">
            <div class="message ">
                <div class="message-inside">
                    <span class="message-text">The username and password you entered did not match our records. Please double-check and try again.</span>
                    <a role="button" class="dismiss" @click.prevent="error=false">
                        <span class="visuallyhidden">Dismiss</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="page-header header-filter">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="card card-signup">
                            <form class="form" @submit.prevent="login">
                                <div class="header header-dark-blue text-center btn-tumblr">
                                    <img class="mr-auto ml-auto" src="/images/logooo2.png" style="width: 200px"/>
                                    <h6 class="text-bold">Project Management System</h6>
                                </div>
                                <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope-o"></i>
                                            </span>
                                            <div class="form-group is-empty">
                                                <input v-model="form.email" type="email" id="email" class="form-control" placeholder="Email..." name="email" required autofocus aria-autocomplete="none">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <!-- <i class="material-icons">lock_outline</i> -->
                                                <i class="fa fa-lock fa-lg"></i>
                                            </span>
                                            <div class="form-group is-empty">
                                                <input v-model="form.password" id="password" type="password" class="form-control" placeholder="Password..." name="password" required>
                                            </div>
                                        </div>

                                        <!-- <div class="input-group">
                                            <div class="checkbox float-right">
                                                <label for="remember">
                                                    <input type="checkbox" checked name="remember" id="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div> -->

                                    </div>

                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-info btn-simple btn-wd btn-md">LOGIN</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
export default {

    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: false
        }
    },

    methods: {
        login() {
            this.$store.dispatch('storeTokenLogin', this.form)
                .then(response => {
                    this.$router.push('/');
                })
                .catch(error => {
                    console.log('error');
                    this.error = true;
                })
        }
    }
    
}
</script>

<style scoped>
.message .message-text {
    display: block;
    margin: 0 20px;
    color: #66757f;
    font-size: 14px;
    line-height: 20px;
    text-align: center;
    word-wrap: break-word;
}
@media only screen and (min-width: 768px) {
    .alert-messages {
        position: fixed;
        top: 46px;
        left: 0;
        right: 0;
        z-index: 999;
        transition: top .5s;
    }

    .message {
        position: relative;
        width: 600px;
        padding: 20px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 0 0 6px 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.25);
    }

    .dismiss {
        color: #66757f;
        opacity: .6;
        -ms-filter: "alpha(opacity=60)";
        filter: "alpha(opacity=60)";
        position: relative;
        left: 90%;
    }
}

@media only screen and (max-width: 767px) {
    
    .message .message-text {
        color: #dd142f;
    }

    .dismiss {
        display: none
    }
}



</style>

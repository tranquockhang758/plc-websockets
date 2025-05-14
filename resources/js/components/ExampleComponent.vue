<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user:{}
            }
        }
        mounted() {
            console.log('Component mounted.')
            Window.Echo.chanel('chat')
            .listen('NewMessage',(dataFromMessage) => {
                console.log('data',dataFromMessage);
            })
        }
    }
</script>

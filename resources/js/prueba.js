import Vue from 'vue'
import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax)
new Vue({
    el:'#app',
    data() {
        return {
          active: false,
           email: '',
           password: '',
           remember: false
          }
    },
    mounted() {

    },
    methods: {
      openNotification(duration) {
                this.$vs.notification({
                  duration,
                  progress: 'auto',
                  title: 'Documentation Vuesax 4.0+',
                  text: `These documents refer to the latest version of vuesax (4.0+),
                  to see the documents of the previous versions you can do it here 👉 Vuesax3.x`
                })
              }
    }
})

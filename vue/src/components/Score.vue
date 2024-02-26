<template>
      <pageComponent>
        <div class="bg-green-600 hover:bg-gray-500 justify-center" >
              <button @click="submit">Click to see result</button>
          </div>
        <div class=" items-center text-black justify-center mt-4 hover:bg-gray-500" v-if="showModal">
           Your test score is {{ score }}% 
        <button @click="finish" class="mt-4 bg-green-500 hover:bg-gray-500">Finish</button>
      </div>
    </pageComponent>
</template>
<script>
import store from '../store';
export default {
  data(){
    return{
      score: this.$route.query.score,
      showModal: false,
      timer: null,
      remainingTime: 0,
    }
  },
  methods:{
    submit(){
      this.showModal = true
      this.timer = setInterval(() => {
        this.remainingTime--;
        if (this.remainingTime <= 0) {
          store.dispatch('signOut')
          .then(()=>{
            localStorage.removeItem('answerArray');
            this.$router.push({
              name:'Login'
            });
          })
        }
      })
    },
    finish(){
      store.dispatch('signOut')
      .then(()=>{
        localStorage.removeItem('answerArray');
        this.$router.push({
          name:'Login'
        });
      })
    }
  },
  mounted() {
    if(localStorage.getItem('finishTime')){
      this.remainingTime = parseInt(localStorage.getItem('finishTime'));
    }
  }
}
</script>
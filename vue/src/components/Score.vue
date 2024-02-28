<template>
      <pageComponent>
        <div class="bg-green-600 hover:bg-gray-500 justify-center" v-if="hideModal">
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
      hideModal:true,
      timer: null,
      timeRemaining: 0,
    }
  },
  methods:{
    submit(){
      this.showModal = true
      this.hideModal = false
      this.timer = setInterval(() => {
        this.timeRemaining--
        localStorage.setItem('timeRemaining', this.timeRemaining.toString())
        if (parseInt(this.timeRemaining) <= 0) {
          localStorage.removeItem('timeRemaining');
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
        this.$router.push({
          name:'Login'
        });
      })
    }
  },
  mounted() {
    if(this.timeRemaining){
      this.timeRemaining = parseInt(localStorage.getItem('timeRemaining'))
    }else{
      this.timeRemaining = 10 * 60
    }
   
    console.log(this.timeRemaining)
  }
  
}
</script>
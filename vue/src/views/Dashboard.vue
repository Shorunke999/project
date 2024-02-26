<template>
    <div>
      <pageComponent> 
        <div class="flex items-center text-black justify-center" v-if="questionData">
          <div>
            <p>{{ countdown }}</p>
          </div>
           <h1 class="text-3xl font-bold text-gray-900">Text Question</h1>
           <div>
             {{ questionData.question }} 
            </div>
          <ul>
            <li v-for="(optionData, index) in questionData.options" :key="index">
              <input type="radio" v-model="studentAnswer[currentPage]" 
               :value="optionData.option" name="option">
              <label for="option"> {{ optionData.option }}</label>
            </li>
          </ul>
           <div class="flex justify-between">
            <button @click="nextPage" class="bg-blue-500 hover:bg-gray-500 justify-end"> Next</button>
            <button @click="backPage" class="bg-blue-500 hover:bg-gray-500 justify-start"> Back </button>
           </div>
          </div>
          <div v-else class="bg-green-600 hover:bg-gray-500 justify-center" >
              <button @click="submit">Click to see result</button>
          </div>
      </pageComponent>
    </div>
</template>
<script>
import axiosClient from "../axios/axios";
import axios from "axios";
import pageComponent from '../components/pageComponent.vue';
export default {
  components: {
    pageComponent
  },
  data(){
    return{
      currentPage: 0,
      questionData:{},
      studentAnswer:{},
      answerArray: JSON.parse(localStorage.getItem('answerArray')) || [],
      countdown: '30:00:00',
      timer: null,
      remainingTime: 0,
    }
  },
  methods:{
    getQuestion(){
      if (this.currentPage < 2 ){
        axiosClient.get(`http://127.0.0.1:8000/api/getQuestion?page=${this.currentPage + 1}`)
            .then((res)=>{
              this.questionData = res.data.data;
              console.log(this.answerArray);
              console.log(this.questionData);
            });
      }else{
        this.questionData = null;

      }
    },
    startCountdown() {
      this.timer = setInterval(() => {
        this.remainingTime--;
        localStorage.setItem('remainingTime', this.remainingTime.toString()); // Store remaining time in localStorage
        if (this.remainingTime <= 0) {
          clearInterval(this.timer);
          // Handle test end here
          this.submit();
        } else {
          this.countdown = this.formatTime(this.remainingTime);
        }
      }, 1000);
    },
    nextPage(){ 
      if(this.studentAnswer[this.currentPage])
      {
        this.answerArray.push({
          questionId: this.questionData.id,
          answer: this.studentAnswer[this.currentPage]
          });   
          console.log(this.answerArray);
          localStorage.setItem('answerArray', JSON.stringify(this.answerArray)); // Update localStorage
          this.currentPage++;  
          this.getQuestion();
        }
      else{
        alert('pls make sure to select an option');
      }
    },
    backPage() {
      if (this.currentPage > 0) {
        this.currentPage--;
        this.getQuestion();
        // Retrieve the selected answer from localStorage and update studentAnswer
        const storedAnswer = JSON.parse(localStorage.getItem('answerArray'));
        if (storedAnswer && storedAnswer[this.currentPage]) {
          this.studentAnswer[this.currentPage] = storedAnswer[this.currentPage].answer;
        }
      } else {
        alert('You are already on the first page.');
       }
  },
    submit(){
      axiosClient.post('http://127.0.0.1:8000/api/answerCheck',this.answerArray)
      .then((res)=>{
        this.$router.push({
          name:'Score',
          query: {
            score: res
          }
        });
      });
    },
    formatTime(timeInSeconds) {
      const hours = Math.floor(timeInSeconds / 3600);
      const minutes = Math.floor((timeInSeconds % 3600) / 60);
      const seconds = timeInSeconds % 60;
      return `${this.pad(hours)}:${this.pad(minutes)}:${this.pad(seconds)}`;
    },
    pad(num) {
      return num.toString().padStart(2, '0');
    },
  },
  mounted() {
    // Check if there is remaining time stored in localStorage
    const storedRemainingTime = localStorage.getItem('remainingTime');
    if (storedRemainingTime) {
      this.remainingTime = parseInt(storedRemainingTime);
    } else {
      this.remainingTime = 30 * 60; // 30 minutes in seconds
    }
    this.startCountdown();
    if (localStorage.getItem('answerArray')){
      this.currentPage = JSON.parse(localStorage.getItem('answerArray')).length;
      console.log('this is the current page lenght to test the lenght method' + this.currentPage);
      this.getQuestion();
    }else{
      
      console.log('this is the current page lenght to test the lenght method' + this.currentPage);
      this.getQuestion();
    }
  },
}
</script>
//https://forms.gle/VvhfZy6fvG8kUAzQ7
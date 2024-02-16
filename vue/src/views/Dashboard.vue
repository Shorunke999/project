<template>
    <div>
      <pageComponent> 
        <div class="flex items-center text-black justify-center">
           <h1 class="text-3xl font-bold text-gray-900">Text Question</h1>
           <div v-if="questionData" class=""> 
              {{ questionData.question }}
          </div>
          <ul>
            <li>
              <input type="radio" v-model="studentAnswer" :value="questionData.options.option_1" name="option_1">
              <label for="option_1"> {{ questionData.options.option_1 }}</label>
            </li>
            <li>
              <input type="radio" v-model="studentAnswer" :value="questionData.options.option_2" name="option_2">
              <label for="option_2"> {{ questionData.options.option_2 }}</label>
            </li>
            <li>
              <input type="radio" v-model="studentAnswer" :value="questionData.options.option_3" name="option_3">
              <label for="option_3"> {{ questionData.options.option_3 }}</label>
            </li>
            <li>
              <input type="radio" v-model="studentAnswer" :value="questionData.options.option_4" name="option_4">
              <label for="option_4"> {{ questionData.options.option_4 }}</label>
            </li>
          </ul>
          
           <div class="flex justify-between">
            <button @click="nextPage" class="bg-blue-500 hover:bg-gray-500 justify-end"> Next</button>
            <button @click="backPage" class="bg-blue-500 hover:bg-gray-500 justify-start"> Back </button>
           </div>
          </div>
      </pageComponent>
    </div>
</template>
<script>
//import axios from '../axios/axios';
import axios from "axios";
import pageComponent from '../components/pageComponent.vue';
export default {
  components: {
    pageComponent
  },
  data(){
    return{
      currentPage: 1,
      questionData:{
        id: null,
        question: '',
        answer: '',
        options:{
          option_1: '',
          option_2:'',
          option_3:'',
          option_4:''
        }
      },
      studentAnswer:null,
      percentage: null
    }
  },
  methods:{
    getQuestion(){
      if (this.currentPage <= 2){
        axios.get(`http://127.0.0.1:8000/api/getQuestion?page=${this.currentPage}`)
            .then((res)=>{
              this.questionData = {...res.data.data};
              //console.log(this.questionData.options.option_1);
              this.studentAnswer = null;
            });
      }
      
    },
    nextPage(){
      if(this.studentAnswer != null){
        if(this.currentPage == 2){
           this.percentFunc();
           return;
        }
        this.currentPage++;  
        this.getQuestion();
      }else{
        alert('pls make sure to select an option');
      }
    },
    backPage(){
      this.currentPage--;
      this.getQuestion();

    },
    percentFunc(){
      if (this.studentAnswer != null && 
      (this.studentAnswer == this.questionData.answer)){
        this.correctAnswer++
      }else if(this.currentPage > 2){
        this.percentage = (this.correctAnswer / 2) * 100;
        console.log('the percentage of the test is ' + this.percentage);
      }
    }
  },
  mounted() {
    if(confirm('Are you ready for the test?')){
      this.getQuestion();
      //console.log('asdfg');
    }
  },
}
</script>
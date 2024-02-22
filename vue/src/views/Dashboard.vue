<template>
    <div>
      <pageComponent> 
        <div class="flex items-center text-black justify-center" v-if="questionData">
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
      questionData:{},
      studentAnswer:{},
      nullable:null,
      answerArray: localStorage.getItem('answerArray'),
      setAnswerArray: localStorage.setItem('answerArray',JSON.stringify(this.answerArray)),
    }
  },
  methods:{
    getQuestion(){
      if(this.currentPage = 1){
        localStorage.setItem('answerArray','[]');
      }
      if (this.currentPage <= 10 ){
        axios.get(`http://127.0.0.1:8000/api/getQuestion?page=${this.currentPage}`)
            .then((res)=>{
              this.questionData = {...res.data.data};
              console.log(this.answerArray)
            });
      }else{
        this.questionData = null;

      }

      
      
    },
    nextPage(){ 
      if(this.studentAnswer[this.currentPage] != {})
      {
        JSON.parse(this.answerArray).push({
          questionId: this.questionData.id,
          answer: this.studentAnswer[this.currentPage]
          });
          this.setAnswerArray;    
          console.log(this.answerArray);
          this.currentPage++;  
          this.getQuestion();
        }
      else{
        alert('pls make sure to select an option');
      }
      /*if(this.studentAnswer[this.currentPage] != {}){
        if (JSON.parse(this.answerArray) != [] && this.answerArray.length > this.currentPage){
          //if the user use the backbutton
          JSON.parse(this.answerArray).splice(this.currentPage-1);//removes answer in the array
          this.answerArray.s({//replace the removed obj in the array with the new answer obj
          questionId:this.questionData.id,
          answer: this.studentAnswer[this.currentPage]
        });
        }else{
          //if the user did not use the backbutton to load the question
         */
    },
    backPage(){
      this.currentPage--;
      this.getQuestion();
      this.studentAnswer[this.currentPage] = JSON.parse(this.answerArray)[this.currentPage-1].answer;
      console.log(this.studentAnswer);
    },
    submit(){
      axios.post('http://127.0.0.1:8000/api/',JSON.parse(this.answerArray))
      .then((res)=>{
        this.$router.push({
          name:'Score',
          query: {
            score: res
          }
        });
      });
    }
  },
  mounted() {
    this.getQuestion();
  },
}
</script>
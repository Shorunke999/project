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
      nullable:null,
      answerArray: JSON.parse(localStorage.getItem('answerArray')) || [],
    }
  },
  methods:{
    getQuestion(){
      if (this.currentPage <= 10 ){
        axios.get(`http://127.0.0.1:8000/api/getQuestion?page=${this.currentPage}`)
            .then((res)=>{
              this.questionData = res.data.data;
              console.log(this.answerArray);
            });
      }else{
        this.questionData = null;

      }
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
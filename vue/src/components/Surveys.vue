<template>
      <pageComponent>
        <div class="flex items-center text-black justify-center">
           <h1 class="text-3xl font-bold text-gray-900">Text Question</h1>
          <div v-if="questionData" class=""> 
              {{ questionData.question }}
          </div>
          <ul>
            <li v-for="questionOption in questionData.option" :key="questionOption.questionNumber">
              <input type="radio" :value="questionOption.value">
            </li>
          </ul>
          
           <div class="flex flex-row">
            <button @click="nextPage" class="bg-blue-500 hover:bg-gray-500 justify-end"> Next</button>
            <button @click="backPage" class="bg-blue-500 hover:bg-gray-500 justify-start"> Back </button>
           </div>
        </div>  
    </pageComponent>
</template>
<script>
export default {
  data(){
    return{
      currentPage: 1,
      questionData:{
        id: '',
        question: '',
        option: {
          questionNumber: null,
          value: ''
        },
        answer:''
      },
      studentAnswer:null,
      percentage: null
    }
  },
  methods:{
    getQuestion(){
      axios.get(`http://127.0.0.1:8000/api/getQuestion?page=${this.currentPage}`)
      .then(res=>{
        this.questionData = res.data.data;
        this.studentAnswer = null;
      });
    },
    nextPage(){
      if(this.studentAnswer != null){
        this.currentPage++;
        this.percentFunc();
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
      if (this.studentAnswer != null && this.studentAnswer == this.questionData.answer){
        this.correctAnswer++
      }else if(this.currentPage = 10){
        this.percentage = (this.correctAnswer / 10) * 100;

      }
    }
  },
  mounted() {
    if(confirm('Are you ready for the test?')){
      this.getQuestion();
    }   
  },
}
</script>
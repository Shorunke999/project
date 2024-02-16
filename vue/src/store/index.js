import {createStore} from 'vuex'
import axiosClient from '../axios/axios';

const tmpSurveys = [
    {
        id:100,
        title: '',
        slug: '',
        status:'',
        image: '',
        description: '',
        created_at:"",
        updated_at:"",
        expire_at:"",
        questions:[
            {
                id: 1,
                type: "select",
                question: "what is your name",
                description:"null",
                data:{
                    options:[
                        {
                            uuid:"",
                            text:"usa",
                        },
                        {
                            uuid:"",
                            text:"germany",
                        },
                        {
                            uuid:"",
                            text:"england",
                        },
                    ]
                }
            },
            {
                id: 2,
                type: "checkbox",
                question: "which language do you use",
                description:"null",
                data:{
                    options:[
                        {
                            uuid:"",
                            text:"javascript",
                        },
                        {
                            uuid:"",
                            text:"python",
                        },
                        {
                            uuid:"",
                            text:"Golang",
                        },
                    ]
                }
            },
            {
                id: 3,
                type: "checkbox",
                question: "which php framework will you like to learn",
                description:"null",
                data:{
                    options:[
                        {
                            uuid:"",
                            text:"Laravel",
                        },
                        {
                            uuid:"",
                            text:"yii",
                        },
                        {
                            uuid:"",
                            text:"symphony",
                        },
                    ]
                }
            },
            {
                id: 4,
                type: "text",
                question: "what is your favourite youtube channel",
                description:"null",
                data:{}
            },
            {
                id: 5,
                type: "textarea",
                question: "what do you think about this youtube channel",
                description:"null",
                data:{}
            }
        ]
    },
    {
        id:200,
        title: '',
        slug: '',
        status:'',
        image: '',
        description: '',
        created_at:"",
        updated_at:"",
        expire_at:"",
        questions:[]
    },
    {
        id:300,
        title: '',
        slug: '',
        status:'',
        image: '',
        description: '',
        created_at:"",
        updated_at:"",
        expire_at:"",
        questions:[]
    },
];
const store = createStore({
    state:{
        user:{
            data:{
                /*
                name: 'Tom Cook',
                email: 'tom@example.com',
                imageUrl:
                    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
            */},
            token: sessionStorage.getItem("TOKEN"),
            },
        surveys:[...tmpSurveys],
        },
    getters:{},
    actions:{
        authAction({commit},info){
                sessionStorage.setItem('TOKEN',info.data.token);
                commit('setUser',info);
            },
        signOut({commit}){
            commit('logout');
        }
    },
    mutations:{
        logout: state =>{
            axiosClient.post('http://127.0.0.1:8000/api/logout')
                .then(()=>{
                    sessionStorage.removeItem('TOKEN');
                    state.user.data ={};
                    state.user.token = null
                });
        },
        setUser: (state, userData)=>{
            state.user.token = userData.data.token;
            state.user.data = userData.data.user;
        }
    },
   modules:{},
})
export default store;
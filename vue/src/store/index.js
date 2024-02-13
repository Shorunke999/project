import {createStore} from 'vuex'
import axiosClient from '../axios/axios';

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
        
        },
    getters:{},
    actions:{
        register({commit},user){
   axiosClient.post('http://127.0.0.1:8000/api/register',user)
            .then((res)=>{
                console.log(res);
                sessionStorage.setItem('TOKEN',res.data.token);
                commit('setUser',res);
                return res;
            })
            }
    },
    mutations:{
        logout: state =>{
            state.user.data ={};
            state.user.token = null
        },
        setUser: (state, userData)=>{
            state.user.token = userData.data.token;
            state.user.data = userData.data.user;
        }
    },
   modules:{},
})
export default store;
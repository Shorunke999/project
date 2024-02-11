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
            axiosClient.post('/register',{
                headers: {
                    'content-type': 'application/json',
                    Accept:'application/json',
                }},user)
            .then((res)=>{
                res.json()
            })
            .then((res)=>{
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
            state.user.data.token = userData.token;
            state.user.data = userData.user;
        }
    },
   modules:{},
})
export default store;
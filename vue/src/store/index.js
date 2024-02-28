import {createStore} from 'vuex'
import axiosClient from '../axios/axios';

const store = createStore({
    state:{
        user:{
            data:{},
            token: sessionStorage.getItem("TOKEN"),
            },
        answer:[],
        },
    getters:{},
    actions:{
        authAction({commit},info){  
            sessionStorage.setItem('TOKEN',info.data.token);
            localStorage.removeItem('remainingTime');
            commit('setUser',info);   
        },
        signOut({commit}){
            commit('logout');
        },
        storeAnswer({commit},{info}){
            commit('storeAnswer',{info});
        }
    },
    mutations:{
        logout: state =>{
                   sessionStorage.removeItem('TOKEN');
                    localStorage.removeItem('remainingTime');
                    state.user.data ={};
                    state.user.token = null;
        },
        setUser: (state, userData)=>{
            state.user.token = userData.data.token;
            state.user.data = userData.data.user;
        },
        storeAnswer:(state, info)=>{
           const aa = state.answer.push(info)
            console.log(aa);
            
        }
    },
   modules:{},
})
export default store;
import axios from "axios";
import store from "../store";
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const axiosClient = axios.create();
axiosClient.interceptors.request.use((config)=>{
    config.headers.Authorization = `Bearer ${store.state.user.token}`;
    return config;
});
export default axiosClient;

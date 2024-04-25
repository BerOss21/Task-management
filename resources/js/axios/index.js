import axios from "axios";

export default function client(){
    const store = useUserStore();
    const axiosClient = axios.create({
        
    })
    
    axiosClient.interceptors.request.use(config => {
        config.headers.Authorization = `Bearer ${store.user.token}`
        return config;
    })

    return {
        axiosClient 
    }
};  
import axios from 'axios'

export async function useData(to, router) {
    let data = {}

    if (window.originURL == window.location.origin + to) {
        // dont make api call
        data = window.apiData
    } else {
        try {
            axios.defaults.withXSRFToken = true;
            const response = await axios.get(to)
            data = response.data
            if (data.errors) {
                data.errors = JSON.parse(data.errors)
            }
        } catch (e) {
            if (e.response.status === 401) {
                router.replace({ path: '/login'})
            }

            if (e.response.status === 403) {
                router.replace({ path: '/unauthorized'})
            }
        }
    }

    return data 
}
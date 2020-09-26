import axios from 'axios';

export default {
    all() {
        return axios.get('/api/categories');
    },
    find(slug) {
        return axios.get(`/api/categories/${slug}`);
    },
    update(id, data) {
        return axios.put(`/api/users/${id}`, data);
    },
};

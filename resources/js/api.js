import axios from "axios";

const ORG_FORMS_URL = "/api/admin/reference-data/org-forms";
const ORG_FORM_URL = id => `/api/admin/reference-data/org-forms/${id}`;

export default {
    getList() {
        return axios.get(ORG_FORMS_URL);
    },
    getItem(id) {
        return axios.get(ORG_FORM_URL(id));
    },
    newItem(title) {
        return axios.post(ORG_FORMS_URL, { title: title });
    },
    editItem(id, title) {
        return axios.put(ORG_FORM_URL(id), { title: title });
    },
    deleteItem(id) {
        return axios.delete(ORG_FORM_URL(id));
    }
};

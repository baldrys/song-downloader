import axios from "axios";

const UPDATING = "UPDATING";
const UPDATING_SUCCESS = "UPDATING_SUCCESS";
const UPDATING_ERROR = "UPDATING_ERROR";

const state = {
    error: null,
    isLoading: false
};

const mutations = {};

const actions = {};

const getters = {
    hasError(state) {
        return state.error !== null;
    },
    error(state) {
        return state.error;
    },
    isLoading(state) {
        return state.isLoading;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};

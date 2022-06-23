const state = {
  token: '',
};

const mutations = {
  SET_TOKEN(state, token) {
    state.token = token;
  },
};

const actions = {
  setCSRF({ commit }, token) {
    commit('SET_TOKEN', token);
  },
};

export default {
  state,
  mutations,
  actions,
};

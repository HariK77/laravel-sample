const getRequest = async (url, params = {}) => {
    return await axios.get(url, params);
}

const postRequest = async (url, params = {}) => {
    return await axios.post(url, params);
}

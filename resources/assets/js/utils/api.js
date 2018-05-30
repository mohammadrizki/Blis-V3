const apiCall = ({url, data, method}) => new Promise((resolve, reject) => {
  setTimeout(() => {
    try {
      
      axios.defaults.headers.common['Authorization'] = localStorage.getItem('user-token');
      if (method == 'GET') {
        axios.get(url).then(({data}) => {
          resolve(data)
        }).catch(({response}) => {                    
          console.log(response.data.message);
        })
      } else if (method == 'POST'){
        axios.post(url,data).then(({data}) => {
          resolve(data)
          console.log(data);
        }).catch(({response}) => {                    
          console.log(response.data.message);
        });
      }
    } catch (err) {
      reject(new Error(err))
    }
  }, 1000)
})

export default apiCall
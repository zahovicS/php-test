import axios from '../api/axios'


// axios
//   .get('https://pokeapi.co/api/v2/pokemon/ditto')
//   .then(function (response) {
//     // handle success
//     console.log(response.data)
//   })
//   .catch(function (error) {
//     // handle error
//     console.log(error)
//   })
//   .finally(function () {
//     // always executed
//   })

  
axios
.get('users',{ Accept: 'application/json' })
.then(function (response) {
  // handle success
  console.log(response)
})
.catch(function (error) {
  // handle error
  console.log(error)
})
.finally(function () {
  // always executed
})

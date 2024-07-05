export function changePageSize({target}) {
    let { search, pathname } = window.location

    if (search == "") {
      this.$router.push(pathname + "?perPage=" + target.value)
    } else {
      const regex = /perPage=\d+/
      const pageRegex = /page=\d+/

      let path = (pathname + search).replace(regex, "perPage=" + target.value)

      if (path.includes('page=')) {
        path = path.replace(pageRegex, 'page=1')
      } else {
        path = path + '&page=1'
      }

      this.$router.push(path)
    }
  }

  export function reorder({orderBy, order}) {
    let { search, pathname } = window.location

    if (search == "") {
      this.$router.push(`${pathname}?orderBy=${orderBy}&order=${order}`)  
    } else {
      const orderByRegex = /orderBy=\w+/
      const orderRegex = /order=\w+/

      let path = (pathname + search)

      if (path.includes('orderBy=')) {
        path = path.replace(orderByRegex, "orderBy=" + orderBy)
      } else {
        path += '&orderBy=' + orderBy
      }
      if (path.includes('order=')) {
        path = path.replace(orderRegex, 'order=' + order)
      } else {
        path += '&order=' + order
      }

      this.$router.push(path)
    }
  }

  export function filter(qStr) {
    const { pathname, href } = window.location

    let params = (new URL(href)).searchParams
    let url = "?"
    
    for (const [key, value] of params) { // get non filter params
      console.log(key, value)
      if ( key.indexOf(".") == -1 ) {
        if (url != "") {
          url+= "&"
        }
        url += `${key}=${value}`
      }
    }
    this.closeSidePanel()

    url = pathname + url 

    if (qStr !== "") {
      url += `&${qStr}`
    }

    this.$router.push(url)
  }


export const BASE_URL = '' 

export const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

export const LOGOUT = ()=>{
    
}

export const GROCERY_LIST_STORE = (data)=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'POST',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
        body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/groceries',
        options:myInit
    } 
}


export const GROCERY_LIST_UPDATE = (id, data)=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'PUT',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
        body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/groceries/'+id,
        options:myInit
    } 
}
export const GROCERY_LIST_GET_ONE = (id, data = {})=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'GET',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
       // body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/groceries/'+id,
        options:myInit
    } 
}

export const GROCERY_LIST_LOAD = (data)=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'POST',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
        body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/groceries',
        options:myInit
    } 
}

export const GROCERY_LIST_ITENS = (data)=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'POST',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
        body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/grocery_items',
        options:myInit
    } 
}
export const GROCERY_LIST_GET_ITEMS = (id, data={})=>{
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json; charset=UTF-8");
    myHeaders.append("Access-Control-Allow-Origin", "*");
    
    data['csrfToken'] = CSRF_TOKEN;

    let myInit = { 
        method: 'GET',
        headers: myHeaders,
        //mode: 'cors',
        //cache: 'no-store',
        //body:JSON.stringify(data)
   };

   return{
        url:BASE_URL+'/api/grocery_items?&grocery_id='+id,
        options:myInit
    } 
}
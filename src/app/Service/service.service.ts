import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {

  constructor(private http: HttpClient) { }

  getUsers() {
    console.log('getUser request started!');
    return this.http.get('http://localhost/pratical-test/slim_api/public/readdata');
  }

  login(data) {
    console.log('Login started!');
    // console.log(data);
    return this.http.post('http://localhost/pratical-test/slim_api/public/login', data);
  }

  registerUser(user) {
    console.log('getUser request started!');
    return this.http.post('http://localhost/pratical-test/slim_api/public/register', user);
  }

  deleteUser(username) {
    console.log('getUser request started!');
    return this.http.delete('http://localhost/pratical-test/slim_api/public/deleteuser/' + username);
  }

  editUser(user, id) {
    console.log('getUser request started!');
    return this.http.put('http://localhost/pratical-test/slim_api/public/updatedata/'+id, user);
  }
}


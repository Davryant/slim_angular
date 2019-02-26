import { Component, OnInit } from '@angular/core';
import { ServiceService } from 'src/app/Service/service.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  private usersObservable : Observable<any[]>;

  constructor(private httpService: ServiceService) { }

  private id = '';
  private username = '';
  private firstname = '';
  private lastname = '';

   users: any;

  ngOnInit() {
        // start query automatically
        this.getUsersFromService()
  }

  private getUsersFromService(){
    this.httpService.getUsers().subscribe(data => {
      console.log('getUser request completed!');
      this.users = data;
      console.log(this.users);
    })
  }

  onClickRefreshList(){
    this.getUsersFromService()
  }

  onClickDeleteUser(username){
    console.log('User to delete: ' + username);
    this.httpService.deleteUser(username).subscribe(respose => {
      console.log(respose);

      this.users = [];
      this.getUsersFromService();
    })

  }

  jazaFomu(id,user, first, last){
    this.username = user;
    this.firstname = first;
    this.lastname = last;
    this.id = id;
  }

  updateData(){
    let user = {
      "firstname": this.firstname,
      "lastname": this.lastname,
      "username": this.username
    }

    this.httpService.editUser(user, this.id).subscribe(data => {
      console.log(data)
      this.getUsersFromService()
    })
  }

}

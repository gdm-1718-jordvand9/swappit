import { Component, OnInit } from '@angular/core';
import { SidenavService } from '../../../services/sidenav.service';

@Component({
  selector: 'app-menu-nav',
  templateUrl: './menu-nav.component.html',
  styleUrls: ['./menu-nav.component.scss']
})
export class MenuNavComponent implements OnInit {

  constructor(private _sidenavService: SidenavService) { }

  ngOnInit() {
  }
  close() {
    this._sidenavService.closeMenuSideNav();
  }

}

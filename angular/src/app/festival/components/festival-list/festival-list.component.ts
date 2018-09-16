import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { Festival } from '../../../core/models/Festival';

@Component({
  selector: 'app-festival-list',
  templateUrl: './festival-list.component.html',
  styleUrls: ['./festival-list.component.scss']
})
export class FestivalListComponent implements OnInit {
  festivals: Array<Festival>;
  loading: boolean = true;

  constructor(private _swappitService: SwappitService) { }

  ngOnInit() {
      this._swappitService.getFestivals().subscribe(data => {
        this.festivals = data;
        this.loading = false;
      })
  }

}

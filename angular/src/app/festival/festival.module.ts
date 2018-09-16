import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FestivalDetailComponent } from './components/festival-detail/festival-detail.component';
import { FestivalPageComponent } from './pages/festival-page/festival-page.component';
import { HttpClientModule } from '@angular/common/http';
import { FestivalListComponent } from './components/festival-list/festival-list.component';
import { FestivalsPageComponent } from './pages/festivals-page/festivals-page.component';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    RouterModule
  ],
  declarations: [
    FestivalDetailComponent,
    FestivalPageComponent,
    FestivalListComponent,
    FestivalsPageComponent
  ],
  exports: [
    FestivalPageComponent,
    FestivalsPageComponent,
  ],
})
export class FestivalModule { }

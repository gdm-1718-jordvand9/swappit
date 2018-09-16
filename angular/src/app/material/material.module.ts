import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatCardModule, MatIconModule, MatSidenavModule, MatToolbarModule, MatDialogModule,  } from '@angular/material';

@NgModule({
  imports: [
    MatCardModule,
    MatIconModule,
    MatSidenavModule,
    MatToolbarModule,
    MatDialogModule,
  ],
  declarations: [],
  exports: [
    MatCardModule,
    MatIconModule,
    MatSidenavModule,
    MatToolbarModule,
    MatDialogModule,
  ],
})
export class MaterialModule { }

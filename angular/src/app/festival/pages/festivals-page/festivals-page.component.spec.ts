import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FestivalsPageComponent } from './festivals-page.component';

describe('FestivalsPageComponent', () => {
  let component: FestivalsPageComponent;
  let fixture: ComponentFixture<FestivalsPageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FestivalsPageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FestivalsPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

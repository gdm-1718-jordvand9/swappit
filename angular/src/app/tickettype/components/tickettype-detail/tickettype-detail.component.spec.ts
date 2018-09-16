import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TickettypeDetailComponent } from './tickettype-detail.component';

describe('TickettypeDetailComponent', () => {
  let component: TickettypeDetailComponent;
  let fixture: ComponentFixture<TickettypeDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TickettypeDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TickettypeDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

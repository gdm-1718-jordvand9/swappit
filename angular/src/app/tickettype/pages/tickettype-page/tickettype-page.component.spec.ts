import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TickettypePageComponent } from './tickettype-page.component';

describe('TickettypePageComponent', () => {
  let component: TickettypePageComponent;
  let fixture: ComponentFixture<TickettypePageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TickettypePageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TickettypePageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

import { Injectable } from '@angular/core';
import { HttpParams } from '@angular/common/http';
import { ActivatedRoute, Params } from '@angular/router';

@Injectable()
export class ParameterService {
  private params: Params;
  constructor(private _route: ActivatedRoute) { }

  setParameters(sort, type) {
    this.params = new HttpParams({
      fromObject: {
        sort: sort,
        type: type
      }
    });
  }

  getParametersFromUrl(): Params {
    this._route.queryParams.subscribe(params => {
      /* this.params = new HttpParams({
        fromObject: params
      }); */
      this.params = params;
      //console.log(params);
    
    });
    return this.params;
  }
}

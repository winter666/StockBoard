import Resource from '@/api/resource';
import request from '../../utils/request';

class BlockchainCurrencyResource extends Resource {
  constructor() {
    super('currency/blockchain');
  }

  graph() {
    return request({
      url: this.uri + '/graph',
      method: 'get',
    });
  }
}

export { BlockchainCurrencyResource as default };

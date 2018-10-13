import React from 'react';
import {shallow} from 'enzyme'
import Exercise from "./Exercise";
import axios from 'axios';

jest.mock('axios', () => {
    const response = {
        data: {
            outputs: [
                {output: 'first word'},
                {output: 'second word'},
                {output: 'third word'},
            ]
        }
    };
    return {
        post: jest.fn(() => Promise.resolve(response))
    }
});

describe('Exercise component', () => {

    it('should make api call when component did mount', () => {
        //when
        const wrapper = shallow(<Exercise words='[{"body": "example word"}]' from={'pl'} to={'en'}/>);
        wrapper.instance().componentDidMount();

        //then
        expect(axios.post).toHaveBeenCalled();
        expect(axios.post).toHaveBeenCalledWith('/exercises/translateAll', {
            words: ['example word'],
            from: 'pl',
            to: 'en'})
    });
});
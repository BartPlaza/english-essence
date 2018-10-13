import React from 'react';
import {shallow} from 'enzyme';
import ExerciseNavigation from "./ExerciseNavigation";

describe('ExerciseNavigation component', () => {
    it('should render show translation button', () => {
        //when
        const wrapper = shallow(<ExerciseNavigation beforeAnswer={true}/>);

        //then
        expect(wrapper.find('.fa-exchange-alt')).toHaveLength(1);
    });

    it('should render two navigation arrows', () => {
        //when
        const wrapper = shallow(<ExerciseNavigation beforeAnswer={false} currentPosition={5} maxPosition={10}/>);

        //then
        expect(wrapper.find('.fa-arrow-alt-circle-left')).toHaveLength(1);
        expect(wrapper.find('.fa-arrow-alt-circle-right')).toHaveLength(1);
    });

    it('should render go back and next arrow', () => {
        //when
        const wrapper = shallow(<ExerciseNavigation beforeAnswer={false} currentPosition={0} maxPosition={10}/>);

        //then
        expect(wrapper.find('.fa-times-circle')).toHaveLength(1);
        expect(wrapper.find('.fa-arrow-alt-circle-right')).toHaveLength(1);
    });

    it('should render back arrow and finish button', () => {
        const wrapper = shallow(<ExerciseNavigation beforeAnswer={false} currentPosition={10} maxPosition={10}/>);

        //then
        expect(wrapper.find('.fa-arrow-alt-circle-left')).toHaveLength(1);
        expect(wrapper.find('.fa-check-circle')).toHaveLength(1);
    });
});